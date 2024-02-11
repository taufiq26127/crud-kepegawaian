<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "kepegawaian";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk mendapatkan data pegawai berdasarkan ID
function getPegawaiById($id)
{
  global $conn;
  $sql = "SELECT pegawai.*, jabatan.nama_jabatan FROM pegawai
          INNER JOIN jabatan ON pegawai.jabatan_id = jabatan.id
          WHERE pegawai.id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $pegawai = $result->fetch_assoc();
  $stmt->close();
  return $pegawai;
}

function getJabatanById($id)
{
  global $conn;
  $sql = "SELECT * FROM jabatan WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $jabatan = $result->fetch_assoc();
  $stmt->close();
  return $jabatan;
}

// Tambahkan pegawai
function tambahPegawai($nama, $jabatan_id, $gaji)
{
  global $conn;
  $stmt = $conn->prepare("CALL tambah_pegawai(?, ?, ?)");
  $stmt->bind_param("sis", $nama, $jabatan_id, $gaji);
  $stmt->execute();
  $stmt->close();
}

// Edit edit pegawai
function editPegawai($id, $nama, $jabatan_id, $gaji)
{
  global $conn;
  $stmt = $conn->prepare("CALL edit_pegawai(?, ?, ?, ?)");
  $stmt->bind_param("isis", $id, $nama, $jabatan_id, $gaji);
  $stmt->execute();
  $stmt->close();
}

// Fungsi edit jabatan
function editJabatan($id, $nama_jabatan)
{
  global $conn;
  // Panggil stored procedure EditJabatan yang telah dibuat sebelumnya
  $sql = "CALL edit_jabatan(?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("is", $id, $nama_jabatan);
  $stmt->execute();
  $stmt->close();
}

// Hapus pegawai
function hapusPegawai($id)
{
  global $conn;
  $stmt = $conn->prepare("CALL hapus_pegawai(?)");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
}

// Ambil semua pegawai
function tampil_pegawai()
{
  global $conn;
  $sql = "CALL tampil_pegawai()";
  $result = $conn->query($sql);
  $pegawai = array();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $pegawai[] = $row;
    }
  }
  return $pegawai;
}

function tambahJabatan($nama_jabatan, $kode_jabatan)
{
  global $conn;
  $sql = "CALL tambah_jabatan(?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $nama_jabatan, $kode_jabatan);
  $stmt->execute();
  $stmt->close();
}

function tampil_jabatan()
{
  global $conn;
  $jabatan = array();
  $sql = "CALL tampil_jabatan()";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $jabatan[] = $row;
    }
  }
  return $jabatan;
}

function hapusJabatan($jabatan_id)
{
  global $conn;
  $sql = "CALL hapus_jabatan(?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $jabatan_id);
  $stmt->execute();
  $stmt->close();
}

// Tutup koneksi
function closeConnection()
{
  global $conn;
  $conn->close();
}
