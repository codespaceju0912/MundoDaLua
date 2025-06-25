<?php
session_start();
include("conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuario WHERE dscEmailUso = ? AND dscSenhaUsu = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$email, $senha]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if($usuario){
    $_SESSION['idUsu'] = $usuario['idUsu'];
    $_SESSION['nomeUsu'] = $usuario['nomeUsu'];
    $_SESSION['tipoUsu'] = $usuario['tipoUsu'];

    if($usuario['tipoUsu'] === 'admin'){
        header("Location: /paginas/admVisaoGeral.php");
    } 
    
    else{
        header("Location: /paginas/index.php");
    }

    exit;
} 

else {
    echo "<script>alert('Usuário ou Senha inválidos!'); window.location.href = '/paginas/login.php';</script>";
}

?>