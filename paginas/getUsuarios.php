<?php
include 'conexao.php';

$sql = "SELECT idUsu, nomUsu, dscEmailUsu FROM usuario";
$result = $conn->query($sql);

$usuario = [];

while($row = $result->fetch_assoc()){
    $usuario[] = row;
}

echo json_encode($usuario);

?>