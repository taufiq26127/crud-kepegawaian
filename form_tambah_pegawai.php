<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Pegawai</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .custom-input {
      width: 40%;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="container">
  <h2>Tambah Pegawai</h2>
  <form method="post" action="proses_tambah_pegawai.php">
    <label class="form-label" for="nama">Nama</label><br>
    <input class="form-control custom-input" type="text" id="nama" name="nama" required><br>
    <label class="form-label" for="jabatan">Jabatan</label><br>
    <select class="form-select custom-input" id="jabatan" name="jabatan" required>
      <?php
      // Ambil daftar jabatan dari database
      include 'koneksi.php';
      $sql = "SELECT * FROM jabatan";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<option value='" . $row["id"] . "'>" . $row["nama_jabatan"] . "</option>";
        }
      }
      ?>
    </select><br>
    <label class="form-label" for="gaji">Gaji</label><br>
    <input class="form-control custom-input" type="text" id="gaji" name="gaji" required><br>
    <a class="btn btn-secondary" href="index.php">Kembali</a>
    <input class="btn btn-primary" type="submit" name="tambah" value="Tambah">
  </form>
</body>

</html>