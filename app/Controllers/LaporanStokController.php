<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\StockLogsModel;

class LaporanStokController extends BaseController
{
    protected $itemModel;
    protected $stockModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->stockModel = new StockLogsModel();
    }


    public function index()
    {
        $tgl_mulai = $this->request->getVar('tgl_mulai') ?? date('Y-m-d');
        $tgl_akhir = $this->request->getVar('tgl_akhir') ?? date('Y-m-d');

        $items = $this->itemModel->orderBy("FIELD(kategori, 'Roti Buled', 'Minuman', 'Inventory', 'Topping', 'Lain-lain')", "ASC", false)->orderBy("nama_barang", "ASC")->findAll();
        $list = [];

        foreach ($items as $item) {
            // 1. Stok Awal (at tgl_mulai)
            $firstLog = $this->stockModel->where('item_id', $item['id'])
                ->where('tanggal', $tgl_mulai)
                ->first();
            
            if ($firstLog) {
                $stokAwal = $firstLog['stok_awal'];
            } else {
                $prevLog = $this->stockModel->getLatestStock($item['id'], $tgl_mulai);
                $stokAwal = $prevLog ? intval($prevLog['jumlah']) : intval($item['isi_satuan'] ?? 0);
            }

            // 2. Sum Masuk & Keluar in range
            $sum = $this->stockModel->selectSum('masuk', 'total_masuk')
                ->selectSum('keluar', 'total_keluar')
                ->where('item_id', $item['id'])
                ->where('tanggal >=', $tgl_mulai)
                ->where('tanggal <=', $tgl_akhir)
                ->first();
            
            $masuk = $sum['total_masuk'] ?? 0;
            $keluar = $sum['total_keluar'] ?? 0;

            // 3. Stok Akhir (at tgl_akhir)
            $lastLog = $this->stockModel->where('item_id', $item['id'])
                ->where('tanggal <=', $tgl_akhir)
                ->orderBy('tanggal', 'DESC')
                ->first();
            
            $stokAkhir = $lastLog ? $lastLog['jumlah'] : $stokAwal;

            $status = 'cukup';
            if ($stokAkhir <= 0) {
                $status = 'kosong';
            } elseif ($stokAkhir < intval($item['isi_satuan'] ?? 0)) {
                $status = 'kurang';
            }

            $list[] = [
                'item'      => $item,
                'stok_awal' => $stokAwal,
                'masuk'     => $masuk,
                'keluar'    => $keluar,
                'stok'      => $stokAkhir,
                'status'    => $status,
            ];
        }

        $data = [
            'title' => 'Laporan Stok',
            'tgl_mulai' => $tgl_mulai,
            'tgl_akhir' => $tgl_akhir,
            'list' => $list,
        ];

        return view('admin/laporan-stok/index', $data);
    }

    // placeholder for PDF export
    public function exportPdf()
    {
        $tgl_mulai = $this->request->getVar('tgl_mulai') ?? date('Y-m-d');
        $tgl_akhir = $this->request->getVar('tgl_akhir') ?? date('Y-m-d');

        $items = $this->itemModel->orderBy("FIELD(kategori, 'Roti Buled', 'Minuman', 'Inventory', 'Topping', 'Lain-lain')", "ASC", false)->orderBy("nama_barang", "ASC")->findAll();
        $list = [];

        foreach ($items as $item) {
            $firstLog = $this->stockModel->where('item_id', $item['id'])
                ->where('tanggal', $tgl_mulai)
                ->first();
            
            if ($firstLog) {
                $stokAwal = $firstLog['stok_awal'];
            } else {
                $prevLog = $this->stockModel->getLatestStock($item['id'], $tgl_mulai);
                $stokAwal = $prevLog ? intval($prevLog['jumlah']) : intval($item['isi_satuan'] ?? 0);
            }

            $sum = $this->stockModel->selectSum('masuk', 'total_masuk')
                ->selectSum('keluar', 'total_keluar')
                ->where('item_id', $item['id'])
                ->where('tanggal >=', $tgl_mulai)
                ->where('tanggal <=', $tgl_akhir)
                ->first();
            
            $masuk = $sum['total_masuk'] ?? 0;
            $keluar = $sum['total_keluar'] ?? 0;

            $lastLog = $this->stockModel->where('item_id', $item['id'])
                ->where('tanggal <=', $tgl_akhir)
                ->orderBy('tanggal', 'DESC')
                ->first();
            
            $stokAkhir = $lastLog ? $lastLog['jumlah'] : $stokAwal;

            $status = 'cukup';
            if ($stokAkhir <= 0) {
                $status = 'kosong';
            } elseif ($stokAkhir < intval($item['isi_satuan'] ?? 0)) {
                $status = 'kurang';
            }

            $list[] = [
                'item'      => $item,
                'stok_awal' => $stokAwal,
                'masuk'     => $masuk,
                'keluar'    => $keluar,
                'stok'      => $stokAkhir,
                'status'    => $status,
            ];
        }

        $data = [
            'title' => 'Laporan Stok ' . ($tgl_mulai == $tgl_akhir ? $tgl_mulai : $tgl_mulai . ' - ' . $tgl_akhir),
            'tgl_mulai' => $tgl_mulai,
            'tgl_akhir' => $tgl_akhir,
            'list' => $list,
        ];

        return view('admin/laporan-stok/print', $data);
    }
}
