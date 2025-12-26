<?php

namespace App\Models;

use CodeIgniter\Model;

class StockLogsModel extends Model
{
    protected $table = 'stock_logs';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['item_id', 'tanggal', 'stok_awal', 'keluar', 'masuk', 'jumlah', 'status'];

    public function getByDate($date)
    {
        return $this->where('tanggal', $date)->findAll();
    }

    public function getByItemAndDate($itemId, $date)
    {
        return $this->where('item_id', $itemId)->where('tanggal', $date)->first();
    }

    public function getLatestStock($itemId, $date)
    {
        return $this->where('item_id', $itemId)
                    ->where('tanggal <', $date)
                    ->orderBy('tanggal', 'DESC')
                    ->first();
    }
}
