<?php
include 'config.php';

$keyword = $_GET['search'] ?? '';

// Query untuk menampilkan data
if ($keyword) {
    $sql = "SELECT * FROM buku WHERE judul LIKE ? OR penulis LIKE ? OR penerbit LIKE ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $like = "%$keyword%";
    $stmt->bind_param("sss", $like, $like, $like);
} else {
    $sql = "SELECT * FROM buku ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Buku - Perpustakaan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fac8dbff; 
      color: #333;
      font-family: "Poppins", sans-serif;
    }

    h2 {
      color: #fc92c7ff;
      font-weight: 600;
      margin-bottom: 25px;
    }

    .container {
      background: #ffffff;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 4px 10px rgba(255, 182, 193, 0.15);
      border: 1px solid #f9d8e6;
    }

    /* Tombol utama (Tambah Buku) */
    .btn-primary {
      background-color: #f8a5c2; /* Pink pastel */
      border: none;
    }
    .btn-primary:hover {
      background-color: #f78fb3;
    }

    /* Tombol pencarian */
    .btn-outline-success {
      color: #d63384;
      border-color: #f5b7d1;
    }
    .btn-outline-success:hover {
      background-color: #f8a5c2;
      color: white;
    }

    /* Input pencarian */
    input.form-control {
      border: 1px solid #f5b7d1;
      background-color: #fff;
    }
    input.form-control:focus {
      border-color: #f8a5c2;
      box-shadow: 0 0 4px rgba(255, 192, 203, 0.6);
    }

    /* Tabel */
    .table {
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
    }
    .table thead {
      background-color: #fde6ee; /* Pink sangat lembut */
      color: #d63384;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
      background-color: #fffafb;
    }
    .table-bordered {
      border-color: #f5b7d1;
    }
    .table th, .table td {
      vertical-align: middle;
      text-align: center;
    }

    /* Tombol edit dan hapus */
    .btn-warning {
      background-color: #ffd1dc;
      border: none;
      color: #d63384;
    }
    .btn-warning:hover {
      background-color: #ffb3c6;
    }
    .btn-danger {
      background-color: #f8a5c2;
      border: none;
    }
    .btn-danger:hover {
      background-color: #f78fb3;
    }

    /* Header */
    .header-bar {
      background-color: #fff;
      border-bottom: 2px solid #fde6ee;
      padding: 15px 0;
      margin-bottom: 20px;
    }
  </style>
</head>
<body class="p-4">
<div class="container">
  <h2 class="text-center">📚 Data Buku Perpustakaan</h2>

  <!-- Form Pencarian -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="tambah.php" class="btn btn-primary">+ Tambah Buku</a>

    <form class="d-flex" method="GET" action="">
      <input class="form-control me-2" type="search" name="search" placeholder="Cari buku..." value="<?= htmlspecialchars($keyword); ?>">
      <button class="btn btn-outline-success" type="submit">Cari</button>
    </form>
  </div>

  <!-- Tabel Data Buku -->
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Penerbit</th>
        <th>Tahun</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>{$no}</td>
                      <td>" . htmlspecialchars($row['judul']) . "</td>
                      <td>" . htmlspecialchars($row['penulis']) . "</td>
                      <td>" . htmlspecialchars($row['penerbit']) . "</td>
                      <td>" . htmlspecialchars($row['tahun_terbit']) . "</td>
                      <td>
                        <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                        <a href='hapus.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin hapus buku ini?\")'>Hapus</a>
                      </td>
                    </tr>";
              $no++;
          }
      } else {
          echo "<tr><td colspan='6' class='text-center text-muted'>Tidak ada data ditemukan.</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
