<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!-- Google Font: Poppins (Modern & Premium) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/adminlte/adminlte_dist/css/adminlte.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <!-- DatePicker -->
    <script src="<?= base_url() ?>/adminlte/plugins/datepicker/js/jquery-1.10.2.js"></script>
    <link href="<?= base_url() ?>/adminlte/plugins/datepicker/css/bootstrap-datepicker.css" rel="stylesheet" media="screen">
    <link href="<?= base_url() ?>/adminlte/plugins/datepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

    <!-- JQueryUI -->
    <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="shortcut icon" type="image/png" href="/RotiBuled.ico">

    <!-- Custom Modern Design System -->
    <style>
        :root {
            --primary-color: #D35400;
            --accent-color: #F5CBA7;
            --secondary-color: #E67E22;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --info-color: #3498db;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --card-glass: rgba(255, 255, 255, 0.98);
            --sidebar-dark: #2c3e50;
            --sidebar-darker: #1a252f;
        }

        /* Global Font Override */
        body, .main-sidebar, .content-wrapper, .main-header {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Prevent Horizontal Scroll */
        body {
            overflow-x: hidden;
        }

        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }

        .wrapper {
            overflow-x: hidden;
        }

        /* Smooth Transitions - exclude transform for layout elements */
        * {
            transition: all 0.3s ease;
        }

        /* Content Wrapper Background */
        .content-wrapper {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8eef3 100%);
        }

        /* Modern Sidebar */
        .main-sidebar {
            background: linear-gradient(180deg, var(--sidebar-dark) 0%, var(--sidebar-darker) 100%) !important;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            overflow-x: hidden !important;
            max-width: 250px;
        }

        .sidebar {
            overflow-x: hidden !important;
        }

        .sidebar .nav {
            overflow-x: hidden !important;
        }

        .sidebar .nav-link {
            border-radius: 10px;
            margin: 4px 8px;
            transition: background 0.3s ease, padding 0.3s ease, box-shadow 0.3s ease;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1) !important;
            padding-left: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color)) !important;
            box-shadow: 0 4px 12px rgba(211, 84, 0, 0.4);
        }

        .sidebar .nav-link p {
            font-weight: 500;
        }

        /* Modern Navbar */
        .main-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
            border-bottom: 2px solid var(--accent-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        /* Enhanced Cards */
        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            background: var(--card-glass);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-bottom: none;
            padding: 15px 20px;
            font-weight: 600;
            border-radius: 15px 15px 0 0 !important;
        }

        .card-header h3 {
            color: white !important;
            font-weight: 600;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }

        .card-body {
            padding: 25px;
        }

        /* Modern Tables */
        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: rgba(211, 84, 0, 0.05);
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,0.02);
        }

        .table-bordered {
            border: 1px solid rgba(0,0,0,0.08);
        }

        /* Modern Buttons */
        .btn {
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
            letter-spacing: 0.5px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 4px 10px rgba(211, 84, 0, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(211, 84, 0, 0.5);
            background: linear-gradient(45deg, var(--secondary-color), var(--primary-color));
        }

        .btn-success {
            background: linear-gradient(45deg, #27ae60, #2ecc71);
            box-shadow: 0 4px 10px rgba(46, 204, 113, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(46, 204, 113, 0.5);
        }

        .btn-danger {
            background: linear-gradient(45deg, #c0392b, #e74c3c);
            box-shadow: 0 4px 10px rgba(231, 76, 60, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(231, 76, 60, 0.5);
        }

        .btn-info {
            background: linear-gradient(45deg, #2980b9, #3498db);
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        }

        .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.5);
        }

        .btn-warning {
            background: linear-gradient(45deg, #d68910, #f39c12);
            box-shadow: 0 4px 10px rgba(243, 156, 18, 0.3);
            color: white;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(243, 156, 18, 0.5);
            color: white;
        }

        .btn-sm {
            padding: 5px 12px;
            font-size: 0.85rem;
        }

        /* Modern Form Inputs */
        .form-control {
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(211, 84, 0, 0.15);
            background: #fff;
        }

        .input-group-text {
            border-radius: 10px;
            background: #f8f9fa;
            border: 2px solid #e0e0e0;
            color: var(--primary-color);
            font-weight: 500;
        }

        /* Enhanced Alerts */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-left: 5px solid var(--success-color);
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border-left: 5px solid var(--danger-color);
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            color: #856404;
            border-left: 5px solid var(--warning-color);
        }

        .alert-info {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
            color: #0c5460;
            border-left: 5px solid var(--info-color);
        }

        /* Modern Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .badge-success {
            background: linear-gradient(45deg, #27ae60, #2ecc71);
        }

        .badge-danger {
            background: linear-gradient(45deg, #c0392b, #e74c3c);
        }

        .badge-warning {
            background: linear-gradient(45deg, #d68910, #f39c12);
        }

        .badge-info {
            background: linear-gradient(45deg, #2980b9, #3498db);
        }

        /* Brand Link Enhancement */
        .brand-link {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
            border-bottom: 2px solid rgba(255,255,255,0.2);
        }

        .brand-text {
            font-weight: 600 !important;
            letter-spacing: 0.5px;
        }

        /* Footer Enhancement */
        .main-footer {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-top: 2px solid var(--accent-color);
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
        }

        /* Breadcrumb Enhancement */
        .breadcrumb {
            background: transparent;
            padding: 0;
        }

        .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        .breadcrumb-item a {
            color: #6c757d;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .breadcrumb-item a:hover {
            color: var(--primary-color);
        }

        /* Content Header Enhancement */
        .content-header h1 {
            color: var(--sidebar-dark);
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.05);
        }

        /* Pagination Enhancement */
        .pagination .page-link {
            border-radius: 8px;
            margin: 0 3px;
            border: none;
            color: var(--primary-color);
            font-weight: 500;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 4px 10px rgba(211, 84, 0, 0.3);
        }

        .pagination .page-link:hover {
            background: var(--accent-color);
            color: var(--primary-color);
        }

        /* Loading Animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .fa-spinner {
            animation: pulse 1.5s ease-in-out infinite;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
    </style>

    <script>
        function isNumberKeyTrue(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (((charCode < 58) && (charCode > 47)) || (charCode == 8))
                return true;
            return false;
        }

        function isNumberKeyTrueWithSpace(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (((charCode < 58) && (charCode > 47)) || (charCode == 8) || (charCode == 32))
                return true;
            return false;
        }

        $(function() {
            $.datepicker.setDefaults({
                monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
                dayNamesMin: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
                // showButtonPanel: true,
                // currentText: "Hari Ini",
                // closeText: "Close",
                nextText: "Berikutnya",
                prevText: "Sebelum",
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: "yy-mm-dd",
                yearRange: "-100:+100",
                changeYear: true,
            });
            $("#tgl1").datepicker({
                onClose: function(selectedDate) {
                    $("#tgl2").datepicker("option", "minDate", selectedDate);
                }
            });
            $("#tgl2").datepicker();
        });
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link">Home</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url('dashboard') ?>" class="brand-link elevation-4">
                <img src="<?= base_url() ?>/adminlte/adminlte_dist/img/RotiBuled.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Roti Buled</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url() ?>/adminlte/adminlte_dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php $name = session()->get('name');
                                                    $nameSplit = explode(" ", $name);
                                                    echo $nameSplit[0] . ' | ' . session()->get('level'); ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <?= $this->include('admin/layout/sidebar'); ?>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= $title ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <?php if (session()->getflashdata('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getflashdata('success'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getflashdata('failed')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getflashdata('failed'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?= $this->renderSection('content'); ?>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 4.5.1
            </div>
            <strong>Copyright &copy; 2025 <a href="https://www.instagram.com/rotibuled/?utm_source=ig_web_button_share_sheet">Roti Buled</a>.</strong> All rights reserved.
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/adminlte/adminlte_dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>/adminlte/adminlte_dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="<?= base_url() ?>/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- DatePicker -->
    <script src="<?= base_url() ?>/adminlte/plugins/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?= base_url() ?>/adminlte/plugins/datepicker/js/bootstrap-datetimepicker.js"></script>
    <!-- JQueryUI -->
    <script src="<?= base_url() ?>/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $(function() {
            $('#dataTable1').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>