<?php
require_once 'koneksi.php';

// Proses Tambah Pegawai
if (isset($_POST['tambah'])) {
  $nama = $_POST['nama'];
  $jabatan = $_POST['jabatan'];
  $gaji = $_POST['gaji'];

  // Panggil fungsi untuk menambahkan pegawai baru
  tambahPegawai($nama, $jabatan, $gaji);

  // Tampilkan pesan Sweet Alert
  echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>"; // Include Sweet Alert script
  echo "<script>
        window.onload = function() {
            Swal.fire({
                title: 'Sukses!',
                text: 'Pegawai berhasil ditambahkan.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = 'index.php';
            });
        };
    </script>";
  exit();
}
