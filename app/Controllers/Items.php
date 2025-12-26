<?php

namespace App\Controllers;

use App\Models\ItemModel;

class Items extends BaseController
{
    protected $itemModel;
    protected $db;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_product') ? $this->request->getVar('page_product') : 1;
        $item = $this->itemModel;
        $keyword = $this->request->getVar('keyword');
        $data = [
            'title' => 'Data Bahan Baku',
            'item'  => $this->itemModel->orderBy("FIELD(kategori, 'Roti Buled', 'Minuman', 'Inventory', 'Topping', 'Lain-lain')", "ASC", false)->orderBy("nama_barang", "ASC")->paginate(25, 'items'),
            'pager' => $this->itemModel->pager,
            'act'   => ['product', ''],
            'currentPage' => $currentpage,
            'keyword' => $keyword,
        ];
        return view('admin/items/index', $data);
    }

    public function pencarian()
    {
        $keyword = $this->request->getVar('keyword');
        return redirect()->to(base_url('/items/search/' . $keyword))->withInput();
    }

    public function cari($keyword)
    {
        $currentpage = $this->request->getVar('page_product') ? $this->request->getVar('page_product') : 1;
        $item = $this->itemModel->cari($keyword);
        $data = [
            'title' => 'Data Produk',
            'item'  => $this->itemModel->cari($keyword)->orderBy("FIELD(kategori, 'Roti Buled', 'Minuman', 'Inventory', 'Topping', 'Lain-lain')", "ASC", false)->orderBy("nama_barang", "ASC")->paginate(25, 'items'),
            'pager' => $this->itemModel->pager,
            'act'   => ['product', ''],
            'currentPage' => $currentpage,
            'keyword' => $keyword,
        ];
        return view('admin/items/index', $data);
    }

    public function detail($id)
    {
        $item = $this->itemModel->find($id);

        if (empty($item)) {
            session()->setflashdata('failed', 'Oops... Data tidak ditemukan. Silahkan pilih data.');
            return redirect()->to(base_url('/items'))->withInput();
        }

        $data = [
            'title' => 'Detail Bahan',
            'item' => $item,
            'act'   => ['product', ''],
        ];
        return view('admin/items/detail', $data);
    }

    public function tambah()
    {
        if (session()->get('level') != "Admin") {
            session()->setflashdata('failed', 'Maaf, hanya admin yang dapat mengakses fitur ini!');
            return redirect()->to(base_url('items'));
        }

        $data = [
            'title' => 'Tambah Bahan',
            'act'   => ['product', ''],
            'validation' => \Config\Services::validation()
        ];
        return view('admin/items/add', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama bahan wajib diisi!',
                ]
            ],
            'minimal_stok' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Minimal stok wajib diisi!',
                    'integer' => 'Minimal stok harus angka bulat'
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan wajib diisi!'
                ]
            ],
            'isi_satuan' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Isi satuan wajib diisi!',
                    'integer' => 'Isi satuan harus angka bulat'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori wajib diisi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/items/create'))->withInput();
        }

        $data = [
            'nama_barang' => $this->request->getVar('nama_barang'),
            'minimal_stok' => $this->request->getVar('minimal_stok'),
            'satuan' => $this->request->getVar('satuan'),
            'isi_satuan' => $this->request->getVar('isi_satuan'),
            'satuan_kemasan' => $this->request->getVar('satuan_kemasan'),
            'kategori' => $this->request->getVar('kategori'),
        ];

        $this->db->transStart();
        $this->itemModel->insert($data);
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            session()->setFlashdata('failed', 'Bahan gagal ditambah.');
            return redirect()->to(base_url('items/create'));
        } else {
            session()->setFlashdata('success', 'Bahan berhasil ditambah.');
            return redirect()->to(base_url('items'));
        }
    }

    public function ubah($id)
    {
        if (session()->get('level') != "Admin") {
            session()->setFlashdata('failed', 'Maaf, hanya admin yang dapat mengakses fitur ini!');
            return redirect()->to(base_url('items'));
        }

        $item = $this->itemModel->find($id);
        if (empty($item)) {
            session()->setFlashdata('failed', 'Oops... Data tidak ditemukan. Silahkan pilih data.');
            return redirect()->to(base_url('/items'))->withInput();
        }

        $data = [
            'title' => 'Edit Bahan',
            'item' => $item,
            'act' => ['items', ''],
            'validation' => \Config\Services::validation()
        ];
        return view('admin/items/edit', $data);
    }

    public function ubah_data($id)
    {
        if (!$this->validate([
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama bahan wajib diisi!'
                ]
            ],
            'minimal_stok' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Minimal stok wajib diisi!',
                    'integer' => 'Minimal stok harus angka bulat'
                ]
            ],
            'isi_satuan' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'Isi satuan wajib diisi!',
                    'integer' => 'Isi satuan harus angka bulat'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/items/edit/' . $id))->withInput();
        }

        $item = $this->itemModel->find($id);

        $data = [
            'nama_barang' => $this->request->getVar('nama_barang'),
            'minimal_stok' => $this->request->getVar('minimal_stok'),
            'satuan' => $this->request->getVar('satuan'),
            'isi_satuan' => $this->request->getVar('isi_satuan'),
            'satuan_kemasan' => $this->request->getVar('satuan_kemasan'),
            'kategori' => $this->request->getVar('kategori'),
        ];

        $this->db->transStart();
        $this->itemModel->update($item['id'], $data);
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            session()->setFlashdata('failed', 'Data bahan gagal diubah.');
            return redirect()->to(base_url('items'));
        } else {
            session()->setFlashdata('success', 'Data bahan berhasil diubah.');
            return redirect()->to(base_url('items/' . $item['id']));
        }
    }
    public function hapus_data($id)
    {
        $item = $this->itemModel->find($id);

        if (!$item) {
            session()->setFlashdata('failed', 'Produk tidak ditemukan.');
            return redirect()->to(base_url('items'));
        }

        $this->db->transStart();
        $this->itemModel->delete($item['id']);
        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            session()->setFlashdata('failed', 'Data bahan gagal dihapus.');
            return redirect()->to(base_url('items'));
        } else {
            session()->setFlashdata('success', 'Data bahan berhasil dihapus.');
            return redirect()->to(base_url('items'));
        }
    }
}
