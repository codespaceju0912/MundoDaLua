<?php
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "mundodalua";

$conn = new mysqli($servername, $username, $password, $dbname);

//Verifica a conexão

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

?>