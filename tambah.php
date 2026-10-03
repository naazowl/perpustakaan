<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'] ?? '';
    $penulis = $_POST['penulis'] ?? '';
    $penerbit = $_POST['penerbit'] ?? '';
    $tahun = $_POST['tahun'] ?? null;

    $sql = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $judul, $penulis, $penerbit, $tahun);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Tambah Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fff;
      font-family: 'Poppins', sans-serif;
      color: #333;
    }
    .container {
      max-width: 600px;
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(255, 105, 180, 0.2);
      border: 2px solid #ffcce0;
    }
    h2 {
      color: #d63384;
      text-align: center;
      font-weight: 700;
      margin-bottom: 25px;
    }
    label {
      color: #d63384;
      font-weight: 500;
    }
    .form-control {
      border: 1px solid #ffcce0;
      background-color: #fff5fa;
    }
    .form-control:focus {
      border-color: #ff80b3;
      box-shadow: 0 0 5px rgba(255, 105, 180, 0.3);
    }
    .btn-success {
      background-color: #ff80b3;
      border: none;
      color: #fff;
    }
    .btn-success:hover {
      background-color: #ff4d94;
    }
    .btn-secondary {
      background-color: #fff;
      color: #d63384;
      border: 1px solid #ff99c8;
    }
    .btn-secondary:hover {
      background-color: #ffe6f0;
    }
  </style>
</head>
<body class="p-4">
<div class="container">
  <h2>Tambah Buku</h2>
  <form method="POST" novalidate>
    <div class="mb-3">
      <label class="form-label">Judul</label>
      <input type="text" name="judul" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Penulis</label>
      <input type="text" name="penulis" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Penerbit</label>
      <input type="text" name="penerbit" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Tahun Terbit</label>
      <input type="number" name="tahun" class="form-control" min="1000" max="9999">
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
