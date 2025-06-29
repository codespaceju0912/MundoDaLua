<?php
require("../conexao.php");

header('Content-Type: application/json');

$nome = filter_input(INPUT_GET, 'nome', FILTER_SANITIZE_STRING);

if (strlen($nome) < 2) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("SELECT idProdt, dscProdt, valProdt, urlImagemProdt 
                        FROM produto 
                        WHERE dscProdt LIKE :nome 
                        LIMIT 10");
$stmt->execute([':nome' => "%$nome%"]);
$produtos = $stmt->fetchAll();

echo json_encode($produtos);