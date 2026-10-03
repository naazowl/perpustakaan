<?php
include 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    $sql = "DELETE FROM buku WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: index.php");
exit;
?>
