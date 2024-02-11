<?php
require_once 'koneksi.php';

// Pastikan ID pegawai telah diterima melalui parameter GET
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Panggil fungsi untuk menghapus pegawai berdasarkan ID
  hapusJabatan($id);

  // Tampilkan pesan Sweet Alert
  echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>"; // Include Sweet Alert script
  echo "<script>
        window.onload = function() {
            Swal.fire({
                title: 'Sukses!',
                text: 'Data berhasil dihapus.',
                icon: 'success',
                confirmButtonText: 'OK',
                target: document.body // Set a valid target parameter
            }).then(function() {
                window.location.href = 'jabatan.php';
            });
        };
    </script>";
  exit();
} else {
  // Jika tidak ada ID pegawai yang diterima, kembalikan pengguna ke halaman index.php atau halaman lainnya
  header("Location: index.php");
  exit();
}
