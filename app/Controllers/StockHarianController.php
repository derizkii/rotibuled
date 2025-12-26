<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\StockLogsModel;

class StockHarianController extends BaseController
{
    protected $db;
    protected $itemsModel;
    protected $stockModel;

    public function __construct()
    {
        $this->itemsModel = new ItemModel();
        $this->stockModel = new StockLogsModel();
    }

    public function index()
    {
        $tanggal = $this->request->getVar('tanggal') ?? date('Y-m-d');

        $items = $this->itemsModel->orderBy("FIELD(kategori, 'Roti Buled', 'Minuman', 'Inventory', 'Topping', 'Lain-lain')", "ASC", false)->orderBy("nama_barang", "ASC")->findAll();
        $stocks = [];
        $prevStocks = [];
        
        foreach ($items as $item) {
            $log = $this->stockModel->getByItemAndDate($item['id'], $tanggal);
            $stocks[$item['id']] = $log;
            
            // Stok Awal for display: use previous day's closing or default to isi_satuan if first time
            $prevLog = $this->stockModel->getLatestStock($item['id'], $tanggal);
            $prevStocks[$item['id']] = $prevLog ? intval($prevLog['jumlah']) : intval($item['isi_satuan'] ?? 0);
        }

        $data = [
            'title'      => 'Stok Harian',
            'items'      => $items,
            'stocks'     => $stocks,
            'prevStocks' => $prevStocks,
            'tanggal'    => $tanggal,
            'act'        => ['stok-harian'],
        ];
        return view('admin/stok-harian/index', $data);
    }

    public function create()
    {
        $tanggal = $this->request->getVar('tanggal') ?? date('Y-m-d');
        $item_id = $this->request->getVar('item_id');

        if ($item_id) {
            $items = $this->itemsModel->where('id', $item_id)->findAll();
        } else {
            $items = $this->itemsModel->orderBy("FIELD(kategori, 'Roti Buled', 'Minuman', 'Inventory', 'Topping', 'Lain-lain')", "ASC", false)->orderBy("nama_barang", "ASC")->findAll();
        }

        $prevStocks = [];
        $stocks = [];
        foreach ($items as $item) {
            $prevLog = $this->stockModel->getLatestStock($item['id'], $tanggal);
            $prevStocks[$item['id']] = $prevLog ? intval($prevLog['jumlah']) : intval($item['isi_satuan'] ?? 0);
            
            $stocks[$item['id']] = $this->stockModel->getByItemAndDate($item['id'], $tanggal);
        }

        $data = [
            'title'           => 'Update Stok Harian',
            'items'           => $items,
            'stocks'          => $stocks,
            'tanggal'         => $tanggal,
            'prevStocks'      => $prevStocks,
            'validation'      => \Config\Services::validation(),
            'act'             => ['stok-harian'],
        ];
        return view('admin/stok-harian/create', $data);
    }

    public function store()
    {
        $rules = [
            'tanggal'   => 'required',
            'item_id.*' => 'required|integer',
            'masuk.*'   => 'required|integer',
            'keluar.*'  => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('/stok-harian/create'))->withInput();
        }

        $tanggal = $this->request->getVar('tanggal');
        $itemIds = $this->request->getVar('item_id');
        $masuks = $this->request->getVar('masuk');
        $keluars = $this->request->getVar('keluar');

        $this->db = \Config\Database::connect();
        $this->db->transStart();

        $errors = [];

        foreach ($itemIds as $index => $itemId) {
            $inputMasuk = intval($masuks[$index]);
            $inputKeluar = intval($keluars[$index]);

            $item = $this->itemsModel->find($itemId);
            if (!$item) continue;

            // Get previous stock (stok_awal): use historical closing or default to isi_satuan
            $prevLog = $this->stockModel->getLatestStock($itemId, $tanggal);
            $stokAwal = $prevLog ? intval($prevLog['jumlah']) : intval($item['isi_satuan'] ?? 0);

            // Validation: keluar TIDAK BOLEH lebih besar dari (stok_awal + masuk)
            if ($inputKeluar > ($stokAwal + $inputMasuk)) {
                $errors[] = "Pemakaian untuk " . $item['nama_barang'] . " (" . $inputKeluar . " " . $item['satuan'] . ") melebihi stok tersedia (" . ($stokAwal + $inputMasuk) . " " . $item['satuan'] . ").";
                continue;
            }

            $stokAkhir = $stokAwal + $inputMasuk - $inputKeluar;

            // Penentuan Status (SETELAH HITUNG)
            // IF stok_akhir == 0 → status = 'kosong'
            // ELSE IF stok_akhir < isi_satuan → status = 'kurang'
            // ELSE → status = 'cukup'
            $status = 'cukup';
            if ($stokAkhir <= 0) {
                $status = 'kosong';
            } elseif ($stokAkhir < intval($item['isi_satuan'] ?? 0)) {
                $status = 'kurang';
            }

            $currentLog = $this->stockModel->getByItemAndDate($itemId, $tanggal);
            
            $dataLog = [
                'item_id'   => $itemId,
                'tanggal'   => $tanggal,
                'stok_awal' => $stokAwal,
                'masuk'     => $inputMasuk,
                'keluar'    => $inputKeluar,
                'jumlah'    => $stokAkhir,
                'status'    => $status,
            ];

            if ($currentLog) {
                $this->stockModel->update($currentLog['id'], $dataLog);
            } else {
                $this->stockModel->insert($dataLog);
            }
        }

        $this->db->transComplete();

        if (!empty($errors)) {
            session()->setFlashdata('failed', implode('<br>', $errors));
            return redirect()->to(base_url('/stok-harian/create?tanggal=' . $tanggal))->withInput();
        }

        if ($this->db->transStatus() === false) {
            session()->setFlashdata('failed', 'Gagal menyimpan stok harian.');
            return redirect()->to(base_url('/stok-harian/create?tanggal=' . $tanggal))->withInput();
        }

        session()->setFlashdata('success', 'Stok harian berhasil disimpan.');
        return redirect()->to(base_url('/stok-harian?tanggal=' . $tanggal));
    }

    public function perTanggal($segment = null)
    {
        $tanggal = $segment ?? $this->request->getVar('tanggal') ?? date('Y-m-d');

        $items = $this->itemsModel->orderBy("FIELD(kategori, 'Roti Buled', 'Minuman', 'Inventory', 'Topping', 'Lain-lain')", "ASC", false)->orderBy("nama_barang", "ASC")->findAll();
        $stocks = [];
        $prevStocks = [];
        
        foreach ($items as $item) {
            $log = $this->stockModel->getByItemAndDate($item['id'], $tanggal);
            $stocks[$item['id']] = $log;
            
            // Stok Awal: previous day's closing or isi_satuan
            $prevLog = $this->stockModel->getLatestStock($item['id'], $tanggal);
            $prevStocks[$item['id']] = $prevLog ? intval($prevLog['jumlah']) : intval($item['isi_satuan'] ?? 0);
        }

        $data = [
            'title'      => 'Stok Harian ' . date('d/m/Y', strtotime($tanggal)),
            'items'      => $items,
            'stocks'     => $stocks,
            'prevStocks' => $prevStocks,
            'tanggal'    => $tanggal,
            'act'        => ['stok-harian'],
        ];

        return view('admin/stok-harian/index', $data);
    }
}