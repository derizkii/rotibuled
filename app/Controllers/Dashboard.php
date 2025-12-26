<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\StockLogsModel;

class Dashboard extends BaseController
{
    protected $itemModel;
    protected $stockLogsModel;

    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->stockLogsModel = new StockLogsModel();
    }

    public function index()
    {
        $tanggal = date('Y-m-d');
        // get stock logs for today where status kurang or kosong
        $builder = $this->stockLogsModel->where('tanggal', $tanggal)->where("status IN ('kurang','kosong')")->get();
        $lowStocks = $builder->getResultArray();

        $data = [
            'title' => 'Dashboard',
            'lowStocks' => $lowStocks,
            'act'   => ['dashboard', ''],
        ];
        return view('admin/dashboard/index', $data);
    }
}
