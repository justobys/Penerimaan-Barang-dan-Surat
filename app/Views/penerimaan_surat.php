<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Penerimaan Surat</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Custom Css -->
  <link rel="stylesheet" href="../css/style.css">
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
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= base_url('Dashboard') ?>" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Dashboard
                </p>
              </a>
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
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
                  <a href="<?= base_url('DaftarSurat') ?>" class="nav-link active">
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
              <h1 class="m-0">Daftar Penerimaan Surat</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Daftar Penerimaan Surat</li>
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
                <div class="card-header">
                  <a href="<?= base_url('DaftarSurat/tambahSurat') ?>" class="btn btn-primary"><i
                      class="fas fa-plus"></i> Tambah</a>
                  <div class="float-right ml-4">
                    <form action="<?= base_url('DaftarSurat') ?>" method="get" class="form-inline">
                      <div class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="Search">
                      </div>
                      <div class="input-group ml-2">
                        <select name="status" class="form-control">
                          <option value="">All</option>
                          <option value="received">Diterima</option>
                          <option value="not_received">Belum Diterima</option>
                        </select>
                      </div>
                      <div class="input-group ml-2">
                        <input type="date" name="StartDate" class="form-control" placeholder="Start Date"
                          aria-label="Start Date">
                        <div class="input-group-append">
                          <span class="input-group-text bg-secondary px-2">s/d</span>
                        </div>
                        <input type="date" name="EndDate" class="form-control" placeholder="End Date"
                          aria-label="End Date">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-success">Search</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                  <table id="tableSurat" class="table table-bordered table-hover" width="100%">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>No. Surat</th>
                        <th>Nama Surat</th>
                        <th>Deskripsi</th>
                        <th>Foto Surat</th>
                        <th>Penerima</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $row = 1;
                      if (isset($data) && is_array($data)):
                        foreach ($data as $p):
                          ?>
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
                              <?= $p['deskripsi'] ?>
                            </td>
                            <td>
                              <?php if (!empty($p['foto_surat'])): ?>
                                <img src="<?= base_url($p['foto_surat']) ?>" alt="Foto Surat" width="150" height="100"
                                  onerror="this.src='<?= base_url('path/to/transparent-image.png') ?>'; this.alt='Image Not Found';">
                              <?php else: ?>
                                <div class="image-not-found">Image Not Found</div>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?= $p['nama_pegawai'] ?>
                            </td>
                            <td>
                              <?php
                              $badgeClass = ($p['status'] == 'Diterima') ? 'badge-success' : 'badge-danger';
                              echo '<span class="badge ' . $badgeClass . '">' . $p['status'] . '</span>';
                              ?>
                            </td>
                            <td class="text-center">
                              <a href="DaftarSurat/ubahSurat/<?= $p['id'] ?>" class="btn btn-warning mb-1">
                                <i class="fas fa-pencil-alt mr-1"></i>Ubah
                              </a>
                              </a><a href="DaftarSurat/kirimWA/<?= $p['id'] ?>" class="btn btn-primary mb-1">
                                <i class="fas fa-paper-plane mr-1"></i>Kirim
                              </a>
                              <button class="btn btn-danger mb-1" onclick="confirmDelete(<?= $p['id'] ?>)">
                                <i class="fas fa-trash mr-1"></i>Delete
                              </button>
                              <!-- <button class="btn btn-primary" data-id="<?= $p['id'] ?>" data-type="barang"
                                onclick="sendEmailNotification(this)">
                                <i class="fas fa-paper-plane mr-1"></i>Send Email
                              </button> -->
                            </td>
                          </tr>
                          <?php
                        endforeach;
                      endif;
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
          <!-- To the right -->
          <div class="float-right d-none d-sm-inline">
            Anything you want
          </div>
          <!-- Default to the left -->
          <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">Andi Muhammad Fadjrin Arif</a>.</strong>
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

      <!-- SweetAlert Success Send Modal -->
      <script>
        <?php if (session()->get('message')): ?>
          Swal.fire({
            icon: 'success',
            title: 'berhasil',
            text: <?php echo json_encode(session()->get('message')); ?>,
          });
        <?php endif; ?>
      </script>

      <!-- SweetAlert Delete -->
      <script>
        function confirmDelete(id) {
          Swal.fire({
            title: 'Apakah anda yakin akan menghapus data ini?',
            text: "Anda tidak akan dapat mengembalikannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = "DaftarSurat/hapusSurat/" + id;
            }
          })
        }
      </script>

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

      <!-- <script>
        function sendEmailNotification(button) {
          var id = $(button).data('id');
          var type = $(button).data('type');

          $.ajax({
            type: 'POST',
            url: '<?= base_url("DaftarSurat/sendEmailNotification") ?>/' + id + '/' + type,
            success: function (response) {
              var result = JSON.parse(response);
              if (result.status === 'success') {
                Swal.fire({
                  icon: 'success',
                  title: 'Notifikasi Terkirim',
                  text: result.message,
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Gagal',
                  text: result.message,
                });
              }
            },
            error: function () {
              Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan saat mengirim notifikasi.',
              });
            }
          });
        }
      </script> -->
</body>

</html>