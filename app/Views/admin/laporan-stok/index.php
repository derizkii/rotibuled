<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('admin/layout/fungsi'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $title ?></h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('laporan-stok') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="tgl_mulai">Dari Tanggal</label>
                            <input type="date" class="form-control" name="tgl_mulai" id="tgl_mulai" value="<?= $tgl_mulai ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="tgl_akhir">Sampai Tanggal</label>
                            <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="<?= $tgl_akhir ?>">
                        </div>
                        <div class="col-md-2" style="padding-top: 32px;">
                            <button type="submit" class="btn btn-info btn-block">
                                <i class="fas fa-search mr-1"></i> Filter
                            </button>
                        </div>
                        <div class="col-md-4 text-right" style="padding-top: 32px;">
                            <a href="<?= base_url('laporan-stok/export-pdf?tgl_mulai=' . $tgl_mulai . '&tgl_akhir=' . $tgl_akhir) ?>" class="btn btn-primary" target="_blank">
                                <i class="fas fa-print mr-1"></i> Cetak Laporan
                            </a>
                        </div>
                    </div>
                </form>

                <hr>

                <div class="alert alert-secondary">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Menampilkan hasil dari: <strong><?= tanggal($tgl_mulai) ?></strong> s/d <strong><?= tanggal($tgl_akhir) ?></strong>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="bg-light text-center">
                                <th style="width: 50px;">No</th>
                                <th>Nama Barang</th>
                                <th>Stok Awal</th>
                                <th>Masuk</th>
                                <th>Keluar</th>
                                <th>Stok Akhir</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($list)) : $i = 1; ?>
                                <?php foreach ($list as $row) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i++ ?></td>
                                        <td class="font-weight-bold"><?= $row['item']['nama_barang'] ?></td>
                                        <td class="text-center"><?= number_format($row['stok_awal'], 0) ?></td>
                                        <td class="text-center text-success">+<?= number_format($row['masuk'], 0) ?></td>
                                        <td class="text-center text-danger">-<?= number_format($row['keluar'], 0) ?></td>
                                        <td class="text-center"><strong><?= number_format($row['stok'], 0) ?></strong></td>
                                        <td class="text-center">
                                            <?php if ($row['status'] == 'kosong') : ?>
                                                <span class="badge badge-danger">Kosong</span>
                                            <?php elseif ($row['status'] == 'kurang') : ?>
                                                <span class="badge badge-warning">Kurang</span>
                                            <?php else : ?>
                                                <span class="badge badge-success">Cukup</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" align="center">Tidak ada data untuk tanggal ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
