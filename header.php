<?php
session_start();

// Periksa apakah sesi admin telah diset
if (!isset($_SESSION['admin'])) {
  header('location:login_admin.php');
  exit(); // Pastikan untuk keluar setelah mengarahkan pengguna ke halaman login
}

include_once 'koneksi.php';

// Ambil nama pengguna admin dari sesi
$nama_admin = $_SESSION['nama_admin'];
?>

<div class="container mt-2" style="background-color: blue; height: 70px; display: flex; align-items: center;">
  <div class="row w-100 justify-content-between align-items-center">
    <div class="col-2">
      <h4 style="color: white;">Kepegawaian</h4>
    </div>
    <div class="col-5 text-right">
      <a class="btn" style="color: white" href="index.php">Pegawai</a>
      <a class="btn" style="color: white" href="jabatan.php">Jabatan</a>
    </div>
    <div class="col-3 text-right">
      <p style="color: white; margin-bottom: 0;">Nama Admin : <?php echo $nama_admin; ?></p>
    </div>
    <div class="col-2 text-right">
      <a class="btn btn-danger btn-sm" href="logout.php">Logout</a>
    </div>
  </div>
</div>