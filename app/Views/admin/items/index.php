<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<?= $this->include('admin/layout/fungsi'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-box mr-2"></i><?= $title ?>
                </h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('items/searching') ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" placeholder="Cari nama bahan..." name="keyword" value="<?= $keyword; ?>" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name="submit">
                                <i class="fas fa-search mr-1"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
                <?php if (session()->get('level') == "Admin") { ?>
                    <p class="mb-4">
                        <a href="<?= base_url('items/create') ?>" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i>Tambah Bahan Baku
                        </a>
                    </p>
                <?php } ?>
                <div class="table-responsive">
                    <table id="dataTable1" class="table table-bordered table-hover table-striped">
                        <thead align="center">
                            <tr>
                                <td style="width: 70px;">No.</td>
                                <td><i class="fas fa-box mr-2"></i>Nama Bahan</td>
                                <td><i class="fas fa-chart-line mr-2"></i>Minimal Stok</td>
                                <td><i class="fas fa-balance-scale mr-2"></i>Satuan</td>
                                <td><i class="fas fa-layer-group mr-2"></i>Isi Kemasan</td>
                                <td><i class="fas fa-tags mr-2"></i>Kategori</td>
                                <td style="width: 150px;"><i class="fas fa-cog mr-2"></i>Action</td> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (25 * ($currentPage - 1));
                            foreach ($item as $data) : ?>
                                <tr>
                                    <td align="center"><strong><?= $i++ ?></strong></td>
                                    <td><strong><?= $data['nama_barang'] ?></strong></td>
                                    <td align="center"><?= $data['minimal_stok'] ?></td>
                                    <td align="center"><?= $data['satuan_kemasan'] ?></td>
                                    <td align="center">
                                         <strong><?= $data['isi_satuan'] ?></strong> <?= $data['satuan'] ?>
                                    </td>
                                    <td align="center">
                                        <span class="badge badge-info"><?= $data['kategori'] ?></span>
                                    </td>
                                    <td align="center">
                                        <a href="<?= base_url('items/' . $data['id']) ?>" class="btn btn-info btn-sm" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if (session()->get('level') == "Admin") { ?>
                                            <a href="<?= base_url('items/edit/' . $data['id']) ?>" class="btn btn-success btn-sm" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="<?= base_url('items/delete/' . $data['id']) ?>" method="post" style="display:inline;">
                                                <?= csrf_field(); ?>
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Yakin Ingin Menghapus Produk Ini?');" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <i class="text-muted">
                        <i class="fas fa-info-circle mr-1"></i>Menampilkan 25 data per halaman.
                    </i>
                    <div>
                        <?= $pager->links('items', 'paging_new'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>