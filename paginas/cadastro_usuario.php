<?php
include("../paginas/conexao.php");

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$senha = $POST['senha'];
$confirmar_senha = $_POST['confirmacao'];

if(!isset($nome, $telefone, $email, $senha, $confirmar_senha)){
    echo "<script>alert('Preencha todos os campos!'); window.location.href = '../paginas/cadastro.php';</script>";
}
?>