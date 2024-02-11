<?php
require_once 'koneksi.php';

// Mendapatkan data pegawai yang akan diedit
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $pegawai = getPegawaiById($id);
} else {
  // Jika tidak ada ID yang diterima, kembalikan pengguna ke halaman index.php atau halaman lainnya
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Pegawai</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .custom-input {
      width: 40%;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="container">
  <h2>Edit Pegawai</h2>
  <form method="post" action="proses_edit_pegawai.php">
    <input type="hidden" name="id" value="<?php echo $pegawai['id']; ?>">
    <label class="form-label" for="nama">Nama:</label><br>
    <input class="form-control custom-input" type="text" id="nama" name="nama" value="<?php echo $pegawai['nama']; ?>"><br>
    <label class="form-label" for="jabatan_id">Jabatan:</label><br>
    <select class="form-select custom-input" id="jabatan_id" name="jabatan_id">
      <?php
      // Ambil daftar jabatan dari database
      $query = "SELECT * FROM jabatan";
      $result = $conn->query($query);

      // Tampilkan opsi jabatan dalam dropdown
      while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id'] . "'";
        if ($row['id'] == $pegawai['jabatan_id']) {
          echo " selected";
        }
        echo ">" . $row['nama_jabatan'] . "</option>";
      }
      ?>
    </select><br>
    <label class="form-label" for="gaji">Gaji:</label><br>
    <input class="form-control custom-input" type="text" id="gaji" name="gaji" value="<?php echo $pegawai['gaji']; ?>"><br>
    <a class="btn btn-secondary" href="index.php">Kembali</a>
    <input class="btn btn-primary" type="submit" name="edit" value="Simpan">
  </form>
</body>

</html>