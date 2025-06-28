<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

if(!isset($_SESSION['eh_admin']) || !$_SESSION['eh_admin']) {
    // Salva a página atual para redirecionar depois
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit;
}

// Opcional: Verifica se usuário ainda existe no banco
include("conexao.php");
$check = $conn->prepare("SELECT 1 FROM usuario WHERE idUsu = ?");
$check->execute([$_SESSION['idUsu']]);
if(!$check->fetch()) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>