<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Data Pegawai</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css') ?>">
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
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Content Wrapper. Contains page content -->
        <div>
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Ubah Data Pegawai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard/index') ?>">Home</a></li>
                                <li class="breadcrumb-item active">Ubah Data Pegawai</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <form action="<?= base_url('Pegawai/edit/' . $dataPegawai['id_pegawai']) ?>"
                                        method="post">
                                        <div class="row">
                                            <!-- Bagian Kiri -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama_pegawai">Nama Pegawai</label>
                                                    <input type="text" class="form-control" id="nama_pegawai"
                                                        name="nama_pegawai" placeholder="Masukkan Nama Pegawai" value="<?= $dataPegawai['nama_pegawai'] ?>"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="Masukkan Email Pegawai" value="<?= $dataPegawai['email'] ?>" required>
                                                </div>
                                                <div class="mt-2 ml-2">
                                                        <button type="button" class="btn btn-danger mr-auto col-auto"
                                                            onclick="window.location.href='<?= base_url('Pegawai') ?>'">Batal</button>
                                                    <button type="submit" class="btn btn-primary ml-auto col-auto">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Footer -->
        <footer class="ml-2 mr-2 mt-auto">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('dist/js/adminlte.min.js') ?>"></script>
    <!-- Page specific script -->
    <!-- SweetAlert Error Modal -->
    <script>
        <?php if (isset($errors) && !empty($errors)): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '<?php echo implode("<br>", $errors); ?>',
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