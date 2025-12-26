<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    // Converted to Items model (table: items)
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = ['nama_barang', 'minimal_stok', 'satuan', 'isi_satuan', 'satuan_kemasan', 'kategori'];
    public function cari($keyword)
    {
        return $this->like('nama_barang', $keyword)
                    ->orLike('kategori', $keyword);
    }
    public function cari_produk($keyword)
    {
        return $this->like('nama_barang', $keyword)->findAll();
    }
}
