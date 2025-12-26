<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('admin/layout/fungsi'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle mr-2"></i><?= $title ?>
                </h3>
            </div>
            <div class="card-body">
                <a href="<?= base_url('items') ?>" class="btn btn-secondary mb-4">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                </a>
                
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td style="width: 35%;" class="bg-light">
                                    <i class="fas fa-box text-primary mr-2"></i><strong>Nama Bahan</strong>
                                </td>
                                <td><strong><?= $item['nama_barang'] ?></strong></td>
                            </tr>
                            <tr>
                                <td class="bg-light">
                                    <i class="fas fa-chart-line text-warning mr-2"></i><strong>Minimal Stok</strong>
                                </td>
                                <td>
                                    <span class="badge badge-warning">
                                        <?= $item['minimal_stok'] ?> <?= $item['satuan_kemasan'] ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-light">
                                    <i class="fas fa-box-open text-warning mr-2"></i><strong>Kemasan</strong>
                                </td>
                                <td><?= $item['satuan_kemasan'] ?? 'pack' ?></td>
                            </tr>
                            <tr>
                                <td class="bg-light">
                                    <i class="fas fa-layer-group text-muted mr-2"></i><strong>Isi per Kemasan</strong>
                                </td>
                                <td><?= $item['isi_satuan'] ?> <?= $item['satuan'] ?></td>
                            </tr>
                            <tr>
                                <td class="bg-light">
                                    <i class="fas fa-balance-scale text-info mr-2"></i><strong>Satuan</strong>
                                </td>
                                <td><?= $item['satuan'] ?></td>
                            </tr>
                            <tr>
                                <td class="bg-light">
                                    <i class="fas fa-tags text-success mr-2"></i><strong>Kategori</strong>
                                </td>
                                <td>
                                    <span class="badge badge-info"><?= $item['kategori'] ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-light">
                                    <i class="fas fa-clock text-danger mr-2"></i><strong>Last Update</strong>
                                </td>
                                <td>
                                    <i class="far fa-calendar-alt mr-1"></i><?= datetime($item['updated_at']) ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>