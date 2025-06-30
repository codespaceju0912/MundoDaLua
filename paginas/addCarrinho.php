<?php
session_start();
include("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['idUsu'])) {
    echo "<script>
        alert('Você precisa estar logado para adicionar ao carrinho!');
        window.location.href = 'login.php';
    </script>";
    exit;
}



$idProdt = $_GET['idProdt'];


$sql = "SELECT * FROM produto WHERE idProdt = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$idProdt]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o produto existe
if (!$produto) {
    die("Produto não encontrado.");
}

// Insere no carrinho
$sql1 = "INSERT INTO carrinho (idUsu, valProdt, idProdt) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql1);
$stmt->execute([$_SESSION['idUsu'], $produto['valProdt'], $produto['idProdt']]);

// Redireciona para a tela do carrinho
header("Location: telaCarrinho.php");
exit;
?>