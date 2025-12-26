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
                <form action="<?= base_url('users/delete/' . $user['id_user']) ?>" method="post">
                    <?= csrf_field(); ?>

                    <div class="form-group row">
                        <label for="nm_user" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nm_user" name="nm_user" value="<?= $user['nm_user'] ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="level" class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="level" name="level" value="<?= $user['level'] ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="status" name="status" value="<?= $user['status'] ?>" readonly>
                        </div>
                    </div>
                    <div class="float-left">
                        <p><a href="<?= base_url('users') ?>" class="btn btn-secondary"><i class="fas fa-undo"></i> Back</a></p>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
