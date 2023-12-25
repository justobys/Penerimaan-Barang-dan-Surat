<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('Dashboard') ?>" class="nav-link">Home</a>
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

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="../img/logo_desnet.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Dashboard</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <?php
                        $session = \Config\Services::session();
                        echo "<a href='#' class='d-block'>" . $session->get('username') . "</a>";
                        ?>

                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?= base_url('Dashboard') ?>" class="nav-link active">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Daftar Penerimaan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('DaftarBarang') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Penerimaan Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('DaftarSurat') ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Penerimaan Surat</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Pegawai') ?>" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Data Pegawai
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('Login/logout'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('Dashboard') ?>">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- Card Header -->
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <div class="input-group mb-3">
                                                <input type="email" class="form-control col-md-12" placeholder="Email"
                                                    name="email" value="<?= $session->get('email') ?>" readonly>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-envelope"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <div class="input-group mb-3">
                                                <input type="username" class="form-control col-12"
                                                    placeholder="username" name="username"
                                                    value="<?= $session->get('username') ?>" readonly>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-user"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?= base_url('UbahPassword') ?>" class="btn btn-primary col-md-12"><span
                                            class="fas fa-edit"></span> Ubah
                                        Password</a>
                                </div>
                            </div>

                            <!-- Penerimaan Barang -->
                            <div class="card">
                                <!-- /.Card Header -->
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-sm-6">
                                            <h4 class="m-0">Table Penerimaan Barang Terbaru</h1>
                                        </div>
                                    </div><!-- /.row -->
                                    <table id="tableBarang" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tanggal</th>
                                                <th>No. Resi</th>
                                                <th>Nama Barang</th>
                                                <th>Penerima</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($tbl_penerimaan_barang)): ?>
                                                <?php $row = 1; ?>
                                                <?php foreach ($tbl_penerimaan_barang as $p): ?>
                                                    <tr>
                                                        <td>
                                                            <?= $row++ ?>
                                                        </td>
                                                        <td>
                                                            <?= date('d/m/Y', strtotime($p['tanggal'])); ?>
                                                        </td>
                                                        <td>
                                                            <?= $p['no_resi'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $p['nama_barang'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $p['nama_pegawai'] ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($p['status'] == 'Diterima'): ?>
                                                                <span class="badge badge-success">Diterima</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-danger">Belum Diterima</span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.Penerimaan Barang -->

                            <!-- Penerimaan Surat -->
                            <div class="card">
                                <!-- /.Card Header -->
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-sm-6">
                                            <h4 class="m-0">Table Penerimaan Surat Terbaru</h1>
                                        </div>
                                    </div><!-- /.row -->
                                    <table id="tableSurat" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tanggal</th>
                                                <th>No. Surat</th>
                                                <th>Nama Surat</th>
                                                <th>Penerima</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($tbl_penerimaan_surat)): ?>
                                                <?php $row = 1; ?>
                                                <?php foreach ($tbl_penerimaan_surat as $p): ?>
                                                    <tr>
                                                        <td>
                                                            <?= $row++ ?>
                                                        </td>
                                                        <td>
                                                            <?= date('d/m/Y', strtotime($p['tanggal'])); ?>
                                                        </td>
                                                        <td>
                                                            <?= $p['no_surat'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $p['nama_surat'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $p['nama_pegawai'] ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($p['status'] == 'Diterima'): ?>
                                                                <span class="badge badge-success">Diterima</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-danger">Belum Diterima</span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.Penerimaan Surat -->
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
                    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
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
            <!-- DataTables  & Plugins -->
            <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
            <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
            <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
            <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
            <!-- AdminLTE App -->
            <script src="../../dist/js/adminlte.min.js"></script>
            <!-- Sweet Alert -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        text: <?php echo json_encode(session()->get('success')); ?>,
                    });
                <?php endif; ?>
            </script>

            <!-- Table Barang -->
            <script>
                $(function () {
                    $('#tableBarang').DataTable({
                        "paging": false,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": false,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                    });
                });
            </script>
            <!-- Table Surat -->
            <script>
                $(function () {
                    $('#tableSurat').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                    });
                });
            </script>
</body>

</html>