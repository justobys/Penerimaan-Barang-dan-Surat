<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Barang</title>

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
                            <h1 class="m-0">Ubah Barang</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard/index') ?>">Home</a></li>
                                <li class="breadcrumb-item active">Ubah Barang</li>
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
                                    <form action="<?= base_url('DaftarBarang/ubahbarang/' . $barang['id']) ?>"
                                        method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <!-- Bagian Kiri -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_resi">No. Resi</label>
                                                    <input type="text" class="form-control" id="no_resi" name="no_resi"
                                                        placeholder="Masukkan No. Resi" required
                                                        value="<?= $barang['no_resi'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_barang">Nama Barang</label>
                                                    <input type="text" class="form-control" id="nama_barang"
                                                        name="nama_barang" placeholder="Masukkan Nama Barang" required
                                                        value="<?= $barang['nama_barang'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="deskripsi">Deskripsi</label>
                                                    <textarea class="form-control" id="deskripsi" name="deskripsi"
                                                        rows="3" placeholder="Masukkan Deskripsi" required
                                                        readonly><?= $barang['deskripsi'] ?></textarea>
                                                </div>
                                            </div>

                                            <!-- Bagian Kanan -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="id_pegawai">Pegawai</label>
                                                    <select class="form-control" id="id_pegawai" name="id_pegawai"
                                                        required disabled>
                                                        <?php foreach ($dataPegawai as $pegawai): ?>
                                                            <option value="<?= $pegawai['id_pegawai'] ?>" <?php if ($barang['id_pegawai'] == $pegawai['id_pegawai']): ?>selected<?php endif; ?> disabled>
                                                                <?= $pegawai['nama_pegawai'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="foto_barang">Foto Barang</label>
                                                    <input type="file" class="form-control-file" id="foto_barang"
                                                        name="foto_barang" accept="image/*" disabled>
                                                </div>
                                                <div class="form-group mt-4">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="Belum Diterima" <?= ($barang['status'] == 'Belum Diterima') ? 'selected' : '' ?>>
                                                            Belum Diterima
                                                        </option>
                                                        <option value="Diterima" <?= ($barang['status'] == 'Diterima') ? 'selected' : '' ?>>
                                                            Diterima
                                                        </option>
                                                    </select>
                                                    <div class="mt-2 ml-2">
                                                        <button type="button" class="btn btn-danger mr-auto col-auto"
                                                            onclick="window.location.href='<?= base_url('DaftarBarang') ?>'">Batal</button>
                                                        <button type="submit"
                                                            class="btn btn-primary ml-auto col-auto">Simpan</button>
                                                    </div>
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