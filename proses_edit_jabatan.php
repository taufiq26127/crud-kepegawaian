<?php
require_once 'koneksi.php';

// Pastikan form telah disubmit dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
  // Ambil nilai ID jabatan dan nama jabatan yang dikirimkan dari form
  $id = $_POST['id'];
  $nama_jabatan = $_POST['nama_jabatan'];

  // Panggil fungsi editJabatan untuk mengedit jabatan
  editJabatan($id, $nama_jabatan);

  // Redirect pengguna ke halaman daftar_jabatan.php setelah proses edit selesai
  // Tampilkan pesan Sweet Alert
  echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>"; // Include Sweet Alert script
  echo "<script>
       window.onload = function() {
           Swal.fire({
               title: 'Sukses!',
               text: 'Jabatan berhasil diedit.',
               icon: 'success',
               confirmButtonText: 'OK'
           }).then(function() {
               window.location.href = 'jabatan.php';
           });
       };
   </script>";
  exit();
} else {
  // Jika tidak ada permintaan edit yang diterima, kembalikan pengguna ke halaman daftar_jabatan.php
  header("Location: daftar_jabatan.php");
  exit();
}
