<?php
include 'koneksi.php';
include 'fungsi/rupiah.php';
include 'header.php';
// Ambil semua data pegawai
$dataPegawai = tampil_pegawai();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Kepegawaian</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="container">
  <h2>Data Pegawai</h2>
  <a class="btn btn-primary" href="form_tambah_pegawai.php">Tambah Pegawai</a>
  <br>
  <br>
  <table border="1" class="table table-bordered text-center align-middle">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Jabatan</th>
      <th>Gaji</th>
      <th>Aksi</th>
    </tr>
    <?php $i = 1;
    foreach ($dataPegawai as $pegawai) : ?>
      <tr>
        <td><?= $i; ?></td>
        <td><?= $pegawai['nama']; ?></td>
        <td><?= $pegawai['nama_jabatan']; ?></td> <!-- Tampilkan nama jabatan -->
        <td><?= rupiah($pegawai['gaji']); ?></td>
        <td>
          <a class="btn btn-warning" href="form_edit_pegawai.php?id=<?= $pegawai['id']; ?>">Edit</a> |
          <a class="btn btn-danger" onclick="return confirmDelete(<?= $pegawai['id']; ?>)">Hapus</a>
      </tr>
    <?php $i++;
    endforeach; ?>
  </table>
  <script>
    function confirmDelete(id) {
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus pegawai ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.isConfirmed) {
          // Redirect to the delete process with the employee ID
          window.location.href = 'hapus_pegawai.php?id=' + id;
        }
      });
    }

    function logout() {
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin keluar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'logout.php';
        }
      });
    }
  </script>
</body>

</html>

<?php
// Tutup koneksi
closeConnection();
?>