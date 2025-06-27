<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include("../paginas/conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];



if (empty($email) || empty($senha)) {
    echo "<script>alert('Preencha todos os campos!'); window.location.href = '../paginas/login.php';</script>";
    exit;
}

$sql = "SELECT * FROM usuario WHERE dscEmailUsu = ? AND dscSenhaUsu = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$email, $senha]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if($usuario){
    $_SESSION['idUsu'] = $usuario['idUsu'];
    $_SESSION['nomeUsu'] = $usuario['nomUsu'];
    
    

    if($usuario['idUsu'] == 1){
        header("Location: ../paginas/admVisaoGeral.php");
    } 
    
    else{
        header("Location: ../index.php");
    }

    exit;
} 

else {
    echo "<script>alert('Usuário ou Senha inválidos!'); window.location.href = '../paginas/login.php';</script>";
}

?>