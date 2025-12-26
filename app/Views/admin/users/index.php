<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i><?= $title ?>
                </h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('users/searching') ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" placeholder="Cari nama atau username..." name="keyword" value="<?= $keyword; ?>" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name="submit">
                                <i class="fas fa-search mr-1"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
                <p class="mb-4">
                    <a href="<?= base_url('users/add') ?>" class="btn btn-primary">
                        <i class="fas fa-user-plus mr-2"></i>Tambah Pengguna
                    </a>
                </p>
                <div class="table-responsive">
                    <table id="dataTable1" class="table table-bordered table-hover table-striped">
                        <thead align="center">
                            <tr>
                                <td style="width: 70px;">No.</td>
                                <td><i class="fas fa-user mr-2"></i>Nama</td>
                                <td><i class="fas fa-id-badge mr-2"></i>Username</td>
                                <td style="width: 120px;"><i class="fas fa-user-tag mr-2"></i>Level</td>
                                <td style="width: 150px;"><i class="fas fa-cog mr-2"></i>Action</td> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (10 * ($currentPage - 1));
                            foreach ($user as $data) : ?>
                                <tr>
                                    <td align="center"><strong><?= $i++ ?></strong></td>
                                    <td><strong><?= $data['nm_user'] ?></strong></td>
                                    <td><?= $data['username'] ?></td>
                                    <td align="center">
                                        <span class="badge badge-<?= $data['level'] == 'Admin' ? 'danger' : 'info' ?>">
                                            <?= $data['level'] ?>
                                        </span>
                                    </td>
                                    <td align="center">
                                        <a href="<?= base_url('users/' . $data['id_user']) ?>" class="btn btn-info btn-sm" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('users/edit/' . $data['id_user']) ?>" class="btn btn-success btn-sm" title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <?php if (session()->get('level') == "Admin") { ?>
                                            <form action="<?= base_url('users/delete/' . $data['id_user']) ?>" method="post" style="display:inline;">
                                                <?= csrf_field(); ?>
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Yakin Ingin Menghapus Data Ini?');" title="Hapus">
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
                        <i class="fas fa-info-circle mr-1"></i>Menampilkan 10 data per halaman.
                    </i>
                    <div>
                        <?= $pager->links('user', 'paging_new'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>