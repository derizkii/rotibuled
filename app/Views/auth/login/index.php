<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Roti Buled</title>

    <!-- Google Font: Poppins (Modern & Friendly) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- AdminLTE (Keep for consistency but override styles) -->
    <link rel="stylesheet" href="<?= base_url() ?>/adminlte/adminlte_dist/css/adminlte.min.css">
    <link rel="shortcut icon" type="image/png" href="/RotiBuled.ico">

    <style>
        :root {
            --primary-color: #D35400; /* Burnt Orange / Golden Brown */
            --accent-color: #F5CBA7;  /* Creamy Bread Color */
            --bg-overlay: rgba(0, 0, 0, 0.6);
            --glass-bg: rgba(255, 255, 255, 0.15);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-color: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=2072&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }

        /* Dark Overlay for better text contrast */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--bg-overlay);
            z-index: 0;
        }

        .login-box {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        /* Glassmorphism Card */
        .card-glass {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            overflow: hidden;
            color: var(--text-color);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--glass-border);
            padding: 25px 20px;
        }

        .card-header .h1 {
            color: var(--text-color);
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            font-size: 2.2rem;
            text-decoration: none;
        }

        .login-box-msg {
            color: #eee;
            font-weight: 300;
            font-size: 1.1rem;
        }

        /* Custom Input Fields */
        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            border: none;
            padding: 22px 15px;
            font-size: 1rem;
            color: #333;
        }

        .form-control:focus {
            background: #fff;
            box-shadow: 0 0 10px rgba(211, 84, 0, 0.5);
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            border: none;
            color: var(--primary-color);
        }

        /* Modern Button */
        .btn-primary-custom {
            background: linear-gradient(45deg, var(--primary-color), #E67E22);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(211, 84, 0, 0.4);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(211, 84, 0, 0.6);
            background: linear-gradient(45deg, #E67E22, #D35400);
        }

        /* Alert Styling */
        .alert {
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            color: #333;
            font-weight: 500;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .alert-success { border-left: 5px solid #2ecc71; }
        .alert-danger { border-left: 5px solid #e74c3c; }

        .brand-subtitle {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>

<body class="hold-transition">
    <div class="login-box">
        <div class="card card-glass">
            <div class="card-header text-center">
                <a href="<?= base_url() ?>" class="h1">
                    <i class="fas fa-bread-slice mr-2"></i>Roti Buled
                </a>
                <span class="brand-subtitle">Cooffee & Bread</span>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Login</p>

                <!-- Flash Data Messages -->
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle mr-2" style="color: #2ecc71;"></i>
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('failed')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle mr-2" style="color: #e74c3c;"></i>
                        <?= session()->getFlashdata('failed'); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('login/masuk') ?>" method="post">
                    <?= csrf_field(); ?>
                    
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-4">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <button type="button" class="input-group-text" id="togglePassword" style="cursor: pointer; background: rgba(255,255,255,0.9); border:none;">
                                <span class="fas fa-eye"></span>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary-custom btn-block" id="btn-login">
                                <i class="fas fa-sign-in-alt mr-2"></i> MASUK
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/adminlte/dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            // Toggle Password
            $('#togglePassword').click(function() {
                const passwordInput = $('#password');
                const icon = $(this).find('span');
                
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Loading State
            $('form').submit(function() {
                const btn = $('#btn-login');
                btn.prop('disabled', true);
                btn.html('<i class="fas fa-spinner fa-spin mr-2"></i> Mohon Tunggu...');
            });
        });
    </script>
</body>

</html>
