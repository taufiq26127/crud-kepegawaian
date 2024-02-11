<?php
require_once 'koneksi.php';

// Proses Edit Pegawai
if (isset($_POST['edit'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $jabatan = $_POST['jabatan_id'];
  $gaji = $_POST['gaji'];

  // Panggil fungsi untuk melakukan edit pegawai
  editPegawai($id, $nama, $jabatan, $gaji);

  // Tampilkan pesan Sweet Alert
  echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>"; // Include Sweet Alert script
  echo "<script>
        window.onload = function() {
            Swal.fire({
                title: 'Sukses!',
                text: 'Pegawai berhasil diedit.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = 'index.php';
            });
        };
    </script>";
  exit();
} else {
  // Jika tidak ada permintaan edit yang diterima, kembalikan pengguna ke halaman index.php atau halaman lainnya
  header("Location: index.php");
  exit();
}
