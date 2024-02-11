<?php
include 'koneksi.php'; // Sertakan file koneksi.php
include 'header.php'; // Sertakan file header.php

// Panggil fungsi untuk mendapatkan daftar jabatan
$jabatan = tampil_jabatan();

// Tutup koneksi
closeConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Jabatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="container">
  <h2>Daftar Jabatan</h2>
  <a class="btn btn-primary" href="form_tambah_jabatan.php">Tambah Jabatan</a>
  <br><br>
  <table border="1" class="table table-bordered text-center align-middle">
    <tr>
      <th>No</th>
      <th>Kode Jabatan</th>
      <th>Nama Jabatan</th>
      <th>Aksi</th>
    </tr>
    <?php $i = 1;
    foreach ($jabatan as $data) : ?>
      <tr>
        <td><?= $i; ?></td>
        <td><?= $data['kode_jabatan']; ?></td>
        <td><?= $data['nama_jabatan']; ?></td>
        <td>
          <a class="btn btn-warning" href="form_edit_jabatan.php?id=<?= $data['id']; ?>">Edit</a> |
          <a class="btn btn-danger" onclick="return confirmDelete(<?= $data['id']; ?>)">Hapus</a>
        </td>
      </tr>
    <?php $i++;
    endforeach; ?>
  </table>
  <script>
    function confirmDelete(id) {
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus jabatan ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.isConfirmed) {
          // Redirect to the delete process with the employee ID
          window.location.href = 'hapus_jabatan.php?id=' + id;
        }
      });
    }
  </script>
</body>

</html>