<?php
require 'conexao.php';

header('Content-Type: application/json');

$dados = json_decode(file_get_contents('php://input'), true);

if (!isset($_POST['idPedido'])) {
    die(json_encode(['success' => false, 'message' => 'ID não fornecido']));
}

$idPedido = $_POST['idPedido'];
$status = $_POST['status'];
$quantidade = $_POST['quantidade'];

try {
    $query = "UPDATE pedido SET 
              dscStatusPedido = ?, 
              qtdProdt = ? 
              WHERE idPedido = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->execute([$status, $quantidade, $idPedido]);
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}