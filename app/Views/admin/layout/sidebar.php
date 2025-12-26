<?php 
$segment = service('uri')->getSegment(1); 
?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="<?= base_url('dashboard') ?>" 
               class="nav-link<?= ($segment == 'dashboard') ? ' active' : ''; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>

        <?php if (session()->get('level') == "Admin") { ?>
        <li class="nav-item">
            <a href="<?= base_url('users') ?>" 
               class="nav-link<?= ($segment == 'users') ? ' active' : ''; ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>Akun</p>
            </a>
        </li>
        <?php } ?>

        <li class="nav-item">
            <a href="<?= base_url('items') ?>" 
               class="nav-link<?= ($segment == 'items') ? ' active' : ''; ?>">
                <i class="nav-icon fas fa-box"></i>
                <p>Bahan Baku</p>
            </a>
        </li>

        <?php if (session()->get('level') == "Admin") { ?>
        <li class="nav-item">
            <a href="<?= base_url('stok-harian') ?>" 
               class="nav-link<?= ($segment == 'stok-harian') ? ' active' : ''; ?>">
                <i class="nav-icon fas fa-clipboard-check"></i>
                <p>Stok Harian</p>
            </a>
        </li>
        <?php } ?>

        <li class="nav-item">
            <a href="<?= base_url('laporan-stok') ?>" 
               class="nav-link<?= ($segment == 'laporan-stok') ? ' active' : ''; ?>">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>Laporan Stok</p>
            </a>
        </li>

        <!-- <?php if (session()->get('level') == "Admin") { ?>
        <li class="nav-item">
            <a href="<?= base_url('report') ?>" 
               class="nav-link<?= ($segment == 'report') ? ' active' : ''; ?>">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>Laporan</p>
            </a>
        </li>
        <?php } ?> -->

        <li class="nav-item">
            <a href="<?= base_url('logout') ?>" class="nav-link">
                <i class="nav-icon fas fa-power-off"></i>
                <p>Log Out</p>
            </a>
        </li>

    </ul>
</nav>
