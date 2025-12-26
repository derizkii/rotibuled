<?php

use App\Controllers\Item;
?>
<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Delete Product</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('items/delete/' . $item['id']) ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="nama_barang" class="col-sm-2 col-form-label">Nama Bahan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $item['nama_barang'] ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="minimal_stok" class="col-sm-2 col-form-label">Minimal Stok</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="minimal_stok" name="minimal_stok" value="<?= $item['minimal_stok'] ?>" readonly>
                        </div>
                        <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="satuan" name="satuan" value="<?= $item['satuan'] ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah Stok</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="jumlah" id="jumlah" value="<?= $item['jumlah'] ?>" readonly>
                        </div>
                    </div>

                    <div class="float-right">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
