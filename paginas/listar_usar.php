<?php
session_start();
include("../paginas/conexao.php");

// Verifica se é admin
if(!isset($_SESSION['admin_logado'])) {
    http_response_code(403);
    exit;
}

$sql = "SELECT id, nomUsu, dscEmailUsu FROM usuario";
$stmt = $conn->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($usuarios);
?>