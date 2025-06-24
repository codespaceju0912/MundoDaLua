<?php
include 'conexao.php';

$nome = $_GET['nome'] ?? '';

$sql = "SELECT * FROM produtos WHERE dscProdt LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->execute(["%$nome%"]);

$produto = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($produto);

?>