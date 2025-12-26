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
                <div class="form-group row mb-4">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $tanggal ?>" onchange="window.location.href='<?= base_url('/stok-harian?tanggal=') ?>'+this.value">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="bg-light text-center">
                                <th style="width: 50px;">No</th>
                                <th>Nama Bahan</th>
                                <th>Stok Awal</th>
                                <th>Satuan Hitung</th>
                                <th>Masuk</th>
                                <th>Keluar</th>
                                <th>Stok Akhir</th>
                                <th>Status</th>
                                <th style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($items)) : $i = 1; $currentKategori = ''; ?>
                                <?php foreach ($items as $item) : ?>
                                    <?php if ($currentKategori != $item['kategori']) : $currentKategori = $item['kategori']; ?>
                                        <tr class="bg-light text-bold">
                                            <td colspan="9"><?= $item['kategori'] ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php 
                                        $log = isset($stocks[$item['id']]) ? $stocks[$item['id']] : null; 
                                        $stokAwal = $prevStocks[$item['id']] ?? 0;
                                        $masuk = $log ? intval($log['masuk']) : 0;
                                        $keluar = $log ? intval($log['keluar']) : 0;
                                        $stokAkhir = $log ? intval($log['jumlah']) : $stokAwal;
                                        
                                        // Daily Consumption Status Logic:
                                        // IF stok_akhir == 0        → status = 'kosong'
                                        // ELSE IF stok_akhir < isi_satuan → status = 'kurang'
                                        // ELSE                     → status = 'cukup'
                                        $status = 'cukup';
                                        if ($stokAkhir <= 0) {
                                            $status = 'kosong';
                                        } elseif ($stokAkhir < intval($item['isi_satuan'] ?? 0)) {
                                            $status = 'kurang';
                                        }
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $i++ ?></td>
                                        <td>
                                            <strong><?= $item['nama_barang'] ?></strong>
                                        </td>
                                        <td class="text-center"><?= number_format($stokAwal, 0) ?></td>
                                        <td class="text-center"><?= $item['satuan'] ?></td>
                                        <td class="text-center text-success">+<?= number_format($masuk, 0) ?></td>
                                        <td class="text-center text-danger">-<?= number_format($keluar, 0) ?></td>
                                        <td class="text-center"><strong><?= number_format($stokAkhir, 0) ?></strong></td>
                                        <td class="text-center">
                                            <?php if ($status == 'kosong') : ?>
                                                <span class="badge badge-danger p-2 btn-block">Kosong</span>
                                            <?php elseif ($status == 'kurang') : ?>
                                                <span class="badge badge-warning p-2 btn-block">Kurang</span>
                                            <?php else : ?>
                                                <span class="badge badge-success p-2 btn-block">Cukup</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url('stok-harian/create?item_id=' . $item['id'] . '&tanggal=' . $tanggal) ?>" class="btn btn-outline-primary btn-sm btn-block">
                                                <i class="fas fa-edit mr-1"></i> Input Stok
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="9" align="center">Tidak ada data</td>
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
