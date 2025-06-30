<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../paginas/conexao.php");

$nome = $_POST['nome'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$email = $_POST['email'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$nascimento = $_POST['nascimento'] ?? '';
$senha = $_POST['senha'] ?? '';
$confirmar_senha = $_POST['confirmacao'] ?? '';

// Validação de campos vazios
if(empty($nome) || empty($telefone) || empty($email) || empty($senha) || empty($confirmar_senha)) {
    echo "<script>alert('Preencha todos os campos!'); window.location.href = '../paginas/cadastro.php';</script>";
    exit;
}

// Verificação se as senhas são iguais
if($senha != $confirmar_senha){
    echo "<script>alert('As senhas estão diferentes!'); window.location.href = '../paginas/cadastro.php';</script>";
    exit;
}

// Verificação se o e-mail já está cadastrado
$sql = "SELECT COUNT(*) FROM usuario WHERE dscEmailUsu = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$email]);
if ($stmt->fetchColumn() > 0) {
    echo "<script>alert('E-mail já cadastrado!'); window.location.href = '../paginas/cadastro.php';</script>";
    exit;
}

$sql = "SELECT COUNT(*) FROM usuario WHERE numTelefUsu = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$telefone]);
if ($stmt->fetchColumn() > 0) {
    echo "<script>alert('Número já cadastrado!'); window.location.href = '../paginas/cadastro.php';</script>";
    exit;
}

$telefone = preg_replace('/\D/', '', $telefone);
$cpf = preg_replace('/\D/', '', $cpf);
// Inserir no banco
$sql = "INSERT INTO usuario(nomUsu, dscEmailUsu, datNascUsu, dscSenhaUsu, numTelefUsu, numCpfUsu)
        VALUES(?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$nome, $email, $nascimento, $senha, $telefone, $cpf]);



 echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href = '../paginas/login.php';</script>";

?>
