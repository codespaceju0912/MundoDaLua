<?php 
include 'conexao.php';

$sql = "SELECT * FROM produto";
$result = $conn->query($sql);

$produto = [];

while($row = $result->fetch_assoc()){
    $produto[] = $row;
}

echo json_encode($produto);

?>