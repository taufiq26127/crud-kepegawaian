<?php
require_once 'koneksi.php';

// Mendapatkan data jabatan yang akan diedit berdasarkan ID yang diterima melalui parameter GET
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $jabatan = getJabatanById($id);
} else {
  // Jika tidak ada ID yang diterima, kembalikan pengguna ke halaman daftar_jabatan.php atau halaman lainnya
  header("Location: daftar_jabatan.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Jabatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .custom-input {
      width: 40%;
    }
  </style>
</head>

<body class="container">
  <h2>Edit Jabatan</h2>
  <form method="post" action="proses_edit_jabatan.php">
    <input type="hidden" name="id" value="<?php echo $jabatan['id']; ?>">
    <label class="form-label" for="kode_jabatan">Kode Jabatan</label><br>
    <input class="form-control custom-input" type="text" id="kode_jabatan" name="kode_jabatan" value="<?php echo $jabatan['kode_jabatan']; ?>" readonly><br>
    <label class="form-label" for="nama_jabatan">Nama Jabatan</label><br>
    <input class="form-control custom-input" type="text" id="nama_jabatan" name="nama_jabatan" value="<?php echo $jabatan['nama_jabatan']; ?>" required><br>
    <a class="btn btn-secondary" href="jabatan.php">Kembali</a>
    <input class="btn btn-primary" type="submit" name="edit" value="Simpan">
  </form>
</body>

</html>