<?php
require 'conexao.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    die(json_encode(['error' => 'ID não fornecido']));
}

$idPedido = $_GET['id'];
$query = "SELECT * FROM pedido WHERE idPedido = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$idPedido]);

$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pedido) {
    die(json_encode(['error' => 'Pedido não encontrado']));
}

echo json_encode($pedido);