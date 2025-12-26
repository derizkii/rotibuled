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
                <form action="<?= base_url('stok-harian/store') ?>" method="post">
                    <?= csrf_field(); ?>

                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-4">
                            <input 
                                type="date" 
                                class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" 
                                name="tanggal" 
                                id="tanggal" 
                                value="<?= old('tanggal') ? old('tanggal') : $tanggal ?>"
                                onchange="window.location.href='<?= base_url('/stok-harian/create?tanggal=') ?>'+this.value"
                            >
                            <div class="invalid-feedback"><?= $validation->getError('tanggal'); ?></div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="bg-light text-center">
                                    <th style="width: 50px;">No</th>
                                    <th>Nama Bahan</th>
                                    <th>Stok Awal</th>
                                    <th style="width: 180px;">Restok (+)</th>
                                    <th style="width: 180px;">Pemakaian (-)</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php if (!empty($items)) : $i = 1; $currentKategori = ''; ?>
                                <?php foreach ($items as $item) : ?>

                                    <!-- Group per kategori -->
                                    <?php if ($currentKategori != $item['kategori']) : ?>
                                        <?php $currentKategori = $item['kategori']; ?>
                                        <tr class="bg-light text-bold">
                                            <td colspan="5"><?= $item['kategori'] ?></td>
                                        </tr>
                                    <?php endif; ?>

                                    <?php 
                                        $stokAwal = $prevStocks[$item['id']] ?? 0;
                                        $log = $stocks[$item['id']] ?? null;
                                        $valMasuk = $log ? $log['masuk'] : 0;
                                        $valKeluar = $log ? $log['keluar'] : 0;
                                    ?>

                                    <tr>
                                        <td class="text-center"><?= $i++ ?></td>
                                        <td>
                                            <strong><?= $item['nama_barang'] ?></strong>
                                            <?php if (!empty($item['satuan_kemasan']) && !empty($item['isi_satuan'])) : ?>
                                                <small class="d-block text-muted">1 <?= $item['satuan_kemasan'] ?> = <?= $item['isi_satuan'] ?> <?= $item['satuan'] ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <strong><?= number_format($stokAwal, 0) ?></strong> <?= $item['satuan'] ?>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <input 
                                                    type="number" 
                                                    step="1" 
                                                    class="form-control restok-input" 
                                                    name="masuk[]" 
                                                    value="<?= $valMasuk ?>"
                                                    min="0"
                                                    required
                                                    data-id="<?= $item['id'] ?>"
                                                    oninput="calculateMax(this)"
                                                >
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><?= $item['satuan'] ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="hidden" name="item_id[]" value="<?= $item['id'] ?>">
                                            <div class="input-group">
                                                <input 
                                                    type="number" 
                                                    step="1" 
                                                    class="form-control keluar-input" 
                                                    id="keluar-<?= $item['id'] ?>"
                                                    name="keluar[]" 
                                                    value="<?= $valKeluar ?>"
                                                    min="0"
                                                    max="<?= $stokAwal + $valMasuk ?>"
                                                    required
                                                    data-stok-awal="<?= $stokAwal ?>"
                                                    oninput="validateUsage(this)"
                                                >
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><?= $item['satuan'] ?></span>
                                                </div>
                                            </div>
                                            <small class="text-danger d-none" id="error-<?= $item['id'] ?>">Melebihi stok!</small>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 text-right">
                        <a href="<?= base_url('stok-harian?tanggal=' . $tanggal) ?>" class="btn btn-secondary mr-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Simpan Stok
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function calculateMax(el) {
    const id = el.getAttribute('data-id');
    const restok = parseInt(el.value) || 0;
    const inputKeluar = document.getElementById('keluar-' + id);
    const stokAwal = parseInt(inputKeluar.getAttribute('data-stok-awal'));
    
    // Update max value for pemakaian
    const totalTersedia = stokAwal + restok;
    inputKeluar.setAttribute('max', totalTersedia);
    
    // Re-validate current usage input
    validateUsage(inputKeluar);
}

function validateUsage(el) {
    const id = el.id.split('-')[1];
    const max = parseInt(el.getAttribute('max'));
    const val = parseInt(el.value) || 0;
    const errorMsg = document.getElementById('error-' + id);
    
    if (val > max) {
        el.classList.add('is-invalid');
        errorMsg.classList.remove('d-none');
        // Optional: force value to max
        // el.value = max; 
    } else {
        el.classList.remove('is-invalid');
        errorMsg.classList.add('d-none');
    }
}
</script>

<?= $this->endSection(); ?>
