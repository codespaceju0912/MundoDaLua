<?php
$servername = "localhost";
$username = "root";
$password = "usbw";
$database = "mundodalua";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET NAMES utf8");
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>

