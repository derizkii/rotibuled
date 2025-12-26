<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('admin/layout/fungsi') ?>
<div class="row">
    <div class="col-lg-12 col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Pemberitahuan Stok Kurang / Kosong Hari Ini
                </h3>
            </div>
            <div class="card-body">
                <?php if (!empty($lowStocks)) : ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th><i class="fas fa-box mr-2"></i>Nama Bahan</th>
                                    <th><i class="fas fa-cubes mr-2"></i>Stok Hari Ini</th>
                                    <th><i class="fas fa-chart-line mr-2"></i>Minimal Stok</th>
                                    <th style="width: 120px;"><i class="fas fa-info-circle mr-2"></i>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($lowStocks as $log) : ?>
                                    <tr>
                                        <td align="center"><?= $i++ ?></td>
                                        <?php $item = (new \App\Models\ItemModel())->find($log['item_id']); ?>
                                        <td><strong><?= $item['nama_barang'] ?></strong></td>
                                        <td align="center">
                                            <span class="badge badge-<?= $log['jumlah'] == 0 ? 'danger' : 'warning' ?>">
                                                <?= $log['jumlah'] ?> <?= $item['satuan'] ?>
                                            </span>
                                        </td>
                                        <td align="center"><?= $item['isi_satuan'] ?> <?= $item['satuan'] ?></td>
                                        <td align="center">
                                            <?php if ($log['status'] == 'kosong') : ?>
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-times-circle mr-1"></i>Kosong
                                                </span>
                                            <?php elseif ($log['status'] == 'kurang') : ?>
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i>Kurang
                                                </span>
                                            <?php else : ?>
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle mr-1"></i>Cukup
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="alert alert-success text-center" role="alert">
                        <i class="fas fa-check-circle fa-3x mb-3" style="color: var(--success-color);"></i>
                        <h5 class="mb-0">
                            <i class="fas fa-smile mr-2"></i>
                            Semua stok dalam kondisi baik! Tidak ada barang dengan stok kurang atau kosong hari ini.
                        </h5>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>