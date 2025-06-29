<?php
include("../php/conexao.php");

$nome = filter_input(INPUT_GET, 'nome', FILTER_SANITIZE_STRING);

header('Content-Type: application/json');

if (strlen($nome) < 2) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT idProdt, dscProdt, valProdt, urlImagemProdt FROM produto WHERE dscProdt LIKE ? LIMIT 10";
$stmt = $conn->prepare($sql);
$termoBusca = "%$nome%";
$stmt->bind_param("s", $termoBusca);
$stmt->execute();
$result = $stmt->get_result();

$produtos = [];
while ($row = $result->fetch_assoc()) {
    $produtos[] = $row;
}

echo json_encode($produtos);
$conn->close();

?>