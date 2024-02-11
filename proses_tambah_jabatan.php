<?php
include 'koneksi.php'; // Sertakan file koneksi.php

// Pastikan form telah disubmit dengan mengonfirmasi bahwa data 'tambah' telah diterima
if (isset($_POST['tambah'])) {
  // Ambil data jabatan dari form
  $nama_jabatan = $_POST['nama_jabatan'];
  $kode_jabatan = $_POST['kode_jabatan']; // Tambahkan baris ini untuk mengambil kode jabatan

  // Panggil fungsi tambahJabatan()
  tambahJabatan($nama_jabatan, $kode_jabatan);

  // Redirect ke halaman daftar jabatan
  header("Location: jabatan.php");
  exit(); // Keluar dari skrip agar tidak menjalankan kode di bawahnya
}

// Tutup koneksi
$conn->close();
