<?php
$servername = "localhost";
$username = "root";
$password = "usbw";
$database = "mundodalua";

$conn = new mysqli($servername, $username, $password, $database);

//Verifica a conexão

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

?>