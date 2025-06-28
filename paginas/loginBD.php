<?php
// FORCE MOSTRAR TODOS OS ERROS
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// VERIFICA MÉTODO POST
if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Acesso inválido. Use o formulário de login.");
}

// VERIFICA CAMPOS OBRIGATÓRIOS
if(empty($_POST['email']) || empty($_POST['senha'])) {
    die("");
}

// INICIA SESSÃO COM SEGURANÇA
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// CONEXÃO COM BANCO (AJUSTE O CAMINHO)
require __DIR__ . '/../paginas/conexao.php';

try {
    // BUSCA USUÁRIO
    $stmt = $conn->prepare("SELECT idUsu, nomUsu, tipoUsu, dscSenhaUsu FROM usuario WHERE dscEmailUsu = ?");
    $stmt->execute([$_POST['email']]);
    $usuario = $stmt->fetch();

    // VERIFICA SENHA (TROQUE POR password_verify() SE USAR HASH)
    if($usuario && $usuario['dscSenhaUsu'] === $_POST['senha']) {
        $_SESSION = [
            'idUsu' => $usuario['idUsu'],
            'nomeUsu' => $usuario['nomUsu'],
            'eh_admin' => ($usuario['tipoUsu'] === 'admin' || $usuario['idUsu'] == 1)
        ];
        
        header("Location: " . ($_SESSION['eh_admin'] ? 'admVisaoGeral.php' : 'index.php'));
        exit;
    } else {
        die("Credenciais inválidas.");
    }
} catch(PDOException $e) {
    die("ERRO DE BANCO DE DADOS: " . $e->getMessage());
}
?>