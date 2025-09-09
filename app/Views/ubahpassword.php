<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Password</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <?php
    $session = \Config\Services::session();
    ?>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link nav-item" href="<?= base_url('Dashboard') ?>" role="button"><i
                            class="fas fa-arrow-left"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('Dashboard') ?>" class="nav-link">Kembali</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        </aside>


        <!-- Content Wrapper. Contains page content -->
        <div>
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Ubah Password</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard/index') ?>">Home</a></li>
                                <li class="breadcrumb-item active">Ubah Password</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- Card Header -->
                                <div class="card-header">
                                    <form action="<?= base_url('UbahPassword/ubah') ?>" method="post"
                                        id="ubahPasswordForm">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <div class="input-group mb-3">
                                                <input type="email" class="form-control col-md-12" placeholder="Email"
                                                    name="email" value="<?= $session->get('email') ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <div class="input-group mb-3">
                                                <input type="username" class="form-control col-12"
                                                    placeholder="username" name="username"
                                                    value="<?= $session->get('username') ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control col-12"
                                                    placeholder="Password" name="password" id="password">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="togglePassword">
                                                        <span class="fas fa-eye"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password2">Konfirmasi Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control col-12"
                                                    placeholder="Password" name="password_confirm"
                                                    id="password_confirm">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <button type="button" class="btn btn-danger mr-auto col-auto"
                                                onclick="window.location.href='<?= base_url('Dashboard') ?>'">Batal</button>
                                            <button type="submit" class="btn btn-primary"><span
                                                    class="fas fa-edit"></span>
                                                Ubah
                                                Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    Anything you want
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">Andi Muhammad Fadjrin
                        Arif</a>.</strong>
                All rights
                reserved.
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="../../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Sweet Alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- AdminLTE App -->
        <script src="../../dist/js/adminlte.min.js"></script>
        <!-- Page specific script -->
        <!-- SweetAlert Error Modal -->
        <script>
            <?php if (session()->get('errors')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: <?php echo json_encode(session()->get('error')); ?>',
                                        });
            <?php endif; ?>
        </script>

        <!-- SweetAlert Success Modal -->
        <script>
            <?php if (session()->get('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Password berhasil diubah!',
                });
            <?php endif; ?>
        </script>

        <!-- Password validation -->
        <script>
            $(document).ready(function () {
                $('#ubahPasswordForm').submit(function () {
                    const password = $('#password').val();
                    const passwordConfirm = $('#password_confirm').val();

                    // Validasi panjang password dan kecocokan password dan konfirmasi
                    if (password.length < 6) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Password harus terdiri dari setidaknya 6 karakter.',
                        });
                        return false;
                    }

                    if (password !== passwordConfirm) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Password dan konfirmasi password tidak cocok.',
                        });
                        return false;
                    }

                    // Lanjutkan dengan mengirim formulir jika validasi berhasil
                    return true;
                });
            });
        </script>

        <!-- Skrip JavaScript untuk toggle password -->
        <script>
            $(document).ready(function () {
                $('#togglePassword').on('click', function () {
                    const passwordFields = $('#password, #password_confirm');

                    passwordFields.each(function () {
                        const passwordField = $(this);
                        const passwordFieldType = passwordField.attr('type');

                        if (passwordFieldType === 'password') {
                            passwordField.attr('type', 'text');
                            $('#togglePassword span').removeClass('fas fa-eye').addClass('fas fa-eye-slash');
                        } else {
                            passwordField.attr('type', 'password');
                            $('#togglePassword span').removeClass('fas fa-eye-slash').addClass('fas fa-eye');
                        }
                    });

                    // Mencegah perilaku default dari tombol
                    event.preventDefault();
                });
            });
        </script>

</body>

</html>