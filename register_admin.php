<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['admin'])) {
  header('location:index.php');
  exit();
}

if (isset($_POST['register'])) {
  $nama = $_POST['nama'];
  $user = $_POST['user'];
  $pass = $_POST['password'];

  // Menjalankan perintah untuk menambahkan admin baru
  $sql = "INSERT INTO admin (nama_admin, username, password) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $nama, $user, $pass);

  try {
    // Eksekusi pernyataan SQL
    $stmt->execute();
    echo "<div class='alert alert-success'>Registrasi berhasil</div>";
  } catch (mysqli_sql_exception $e) {
    // Tangkap dan tampilkan pesan kesalahan
    $errorMessage = $e->getMessage();
    echo "<div class='alert alert-danger'>$errorMessage</div>";

    // Simpan pesan kesalahan ke dalam tabel system_log
    $logSql = "INSERT INTO system_log (type, message, created_at) VALUES ('ERROR', ?, NOW())";
    $logStmt = $conn->prepare($logSql);
    $logStmt->bind_param("s", $errorMessage);
    $logStmt->execute();
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

  <title>Registrasi Admin</title>
  <!-- SweetAlert CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class=" container bg-gradient-primary">

  <div class="container text-center" style="width: 1000px;">

    <!-- Outer Row -->
    <div class="row justify-content-center" style="margin-top: 50px;">
      <div class="col-xl-8 col-lg-12 col-md-9 col-sm-6">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Registrasi Admin</h1>
                    <br>
                  </div>
                  <form class="user" method="POST" action="">
                    <div class="form-group">
                      <input type="text" autocomplete="off" required name="nama" class="form-control form-control-user" id="exampleInputEmailNama" aria-describedby="emailHelp" placeholder="Nama...">
                    </div>
                    <div class="form-group">
                      <input type="text" autocomplete="off" required name="user" class="form-control form-control-user" id="exampleInputEmailUser" aria-describedby="emailHelp" placeholder="Username...">
                    </div>
                    <div class="form-group">
                      <input type="password" autocomplete="off" required name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <button type="submit" name="register" class="btn btn-primary btn-user btn-block">
                      Registrasi
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="login_admin.php">Sudah punya akun? Login!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>