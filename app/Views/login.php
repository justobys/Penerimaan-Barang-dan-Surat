<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- data-aos -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .login-box {
            width: 350px;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box" data-aos="fade-down" data-aos-duration="3000">
        <!-- login logo -->
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="text-center">
                    <img src="<?= base_url('img/logo_desnet.png') ?>" alt="logo" class="mb-3">
                    <div class="card-body mt-auto">
                        <h4 class="login-box-title">Aplikasi Pendataan Kiriman Barang & Surat</h4>
                    </div>
                </div>
                <!-- <p class="login-box-msg">login</p> -->
                <form action="<?= base_url('/Login/auth') ?>" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control col-12" placeholder="Email" name="email" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control col-12" placeholder="Password" name="password"
                                required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="icheck-primary mt-auto">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.login-card-body -->
        <!-- jQuery -->
        <script src="../../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../dist/js/adminlte.min.js"></script>
        <!-- data-aos -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="../js/main.js"></script>
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
</body>

</html>