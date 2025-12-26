<?php

use App\Controllers\Item;
?>
<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i><?= $title ?>
                </h3>
            </div>
            <div class="card-body">
                <?php if ($validation->getErrors()) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <strong>Terjadi Kesalahan!</strong>
                        <ul class="mb-0 mt-2">
                            <?php foreach ($validation->getErrors() as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('items/update/' . $item['id']) ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="nama_barang" class="col-sm-3 col-form-label">
                            <i class="fas fa-box text-primary mr-2"></i>Nama Bahan
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= ($validation->hasError('nama_barang')) ? 'is-invalid' : ''; ?>" id="nama_barang" name="nama_barang" value="<?= (old('nama_barang')) ? old('nama_barang') : $item['nama_barang'] ?>" placeholder="Masukkan nama bahan baku" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_barang'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="minimal_stok" class="col-sm-3 col-form-label">
                            <i class="fas fa-chart-line text-warning mr-2"></i>Minimal Stok
                        </label>
                        <div class="col-sm-9">
                            <input type="number" step="0.1" class="form-control <?= ($validation->hasError('minimal_stok')) ? 'is-invalid' : ''; ?>" id="minimal_stok" name="minimal_stok" value="<?= (old('minimal_stok')) ? old('minimal_stok') : $item['minimal_stok'] ?>" placeholder="Contoh: 5" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('minimal_stok'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="satuan_kemasan" class="col-sm-3 col-form-label">
                            <i class="fas fa-box-open text-warning mr-2"></i>Kemasan
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="satuan_kemasan" name="satuan_kemasan" value="<?= (old('satuan_kemasan')) ? old('satuan_kemasan') : ($item['satuan_kemasan'] ?? 'pack') ?>" placeholder="Contoh: Ball, Pack, Dus, Botol" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="isi_satuan" class="col-sm-3 col-form-label">
                            <i class="fas fa-layer-group text-muted mr-2"></i>Isi per Kemasan
                        </label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control <?= ($validation->hasError('isi_satuan')) ? 'is-invalid' : ''; ?>" id="isi_satuan" name="isi_satuan" value="<?= (old('isi_satuan')) ? old('isi_satuan') : ($item['isi_satuan'] ?? 1) ?>" placeholder="Jumlah unit di dalam 1 kemasan" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('isi_satuan'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="satuan" class="col-sm-3 col-form-label">
                            <i class="fas fa-balance-scale text-info mr-2"></i>Satuan
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= ($validation->hasError('satuan')) ? 'is-invalid' : ''; ?>" id="satuan" name="satuan" value="<?= (old('satuan')) ? old('satuan') : $item['satuan'] ?>" placeholder="Contoh: pcs, kg, ml" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('satuan'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kategori" class="col-sm-3 col-form-label">
                            <i class="fas fa-tags text-success mr-2"></i>Kategori
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>" name="kategori" id="kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Roti Buled" <?= (old('kategori')) ? (old('kategori') == 'Roti Buled' ? 'selected' : '') : ($item['kategori'] == 'Roti Buled' ? 'selected' : '') ?>>Roti Buled</option>
                                <option value="Minuman" <?= (old('kategori')) ? (old('kategori') == 'Minuman' ? 'selected' : '') : ($item['kategori'] == 'Minuman' ? 'selected' : '') ?>>Minuman</option>
                                <option value="Inventory" <?= (old('kategori')) ? (old('kategori') == 'Inventory' ? 'selected' : '') : ($item['kategori'] == 'Inventory' ? 'selected' : '') ?>>Inventory</option>
                                <option value="Topping" <?= (old('kategori')) ? (old('kategori') == 'Topping' ? 'selected' : '') : ($item['kategori'] == 'Topping' ? 'selected' : '') ?>>Topping</option>
                                <option value="Lain-lain" <?= (old('kategori')) ? (old('kategori') == 'Lain-lain' ? 'selected' : '') : ($item['kategori'] == 'Lain-lain' ? 'selected' : '') ?>>Lain-lain</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('kategori'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= base_url('items') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>