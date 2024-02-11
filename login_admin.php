<?php
session_start();
include_once 'koneksi.php';

if (isset($_SESSION['admin'])) {
  header('location:index.php');
  exit();
}

if (isset($_POST['login'])) {
  $user = htmlentities(strip_tags($_POST['user']));
  $pass = htmlentities(strip_tags($_POST['pass']));

  // Panggil stored procedure
  $stmt = $conn->prepare("CALL login_admin(?, ?, @out_id_admin, @out_nama_admin)");
  $stmt->bind_param("ss", $user, $pass);
  $stmt->execute();

  // Ambil nilai output
  $result = $conn->query("SELECT @out_id_admin, @out_nama_admin");
  $row = $result->fetch_assoc();
  $id_admin = $row['@out_id_admin'];
  $nama_admin = $row['@out_nama_admin'];

  // Handle pesan berdasarkan hasil login
  if ($id_admin) {
    $_SESSION['admin'] = $id_admin;
    $_SESSION['nama_admin'] = $nama_admin;
    $message = 'Login berhasil';
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
    echo "<script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil',
                    text: '$message',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'index.php';
                });
            };
         </script>";
    exit();
  } else {
    // Handle pesan error jika login gagal
    $message = 'Login Gagal. User admin tidak tersedia atau password yang Anda masukkan salah.';
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
    echo "<script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: '$message',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = 'login_admin.php';
                });
            };
         </script>";
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Data Pegawai</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- SweetAlert CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="container bg-gradient-primary">
  <div class="container text-center" style="width: 1000px;">

    <!-- Outer Row -->
    <div class="row justify-content-center" style="margin-top: 50px;">
      <div class="col-xl-8 col-lg-12 col-md-9 col-sm-6">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Selamat Datang!</h1>
                    <br>
                  </div>
                  <form class="user" method="POST" action="">
                    <div class="form-group">
                      <input type="text" autocomplete="off" required name="user" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan username...">
                    </div>
                    <div class="form-group">
                      <input type="password" autocomplete="off" required name="pass" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                      Login Admin
                    </button>
                    <hr>
                    <a href="register_admin.php" class="btn btn-warning btn-user btn-block">Register Admin</a>
                  </form>
                </div>
              </div>
              <div class="col-lg-4 align-self-center">
                <img src="img/1.jpg" alt="" style="width: 180px; margin-bottom: 50px;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages -->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>