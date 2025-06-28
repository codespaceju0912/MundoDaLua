<?php
session_start();
include("../paginas/conexao.php");

// Verifica se é um adm logado
if(!isset($_SESSION['admin_logado'])) {
    echo json_encode(['status' => 'error', 'message' => 'Acesso não autorizado!']);
    exit;
}

$nome = $_POST['nome'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$email = $_POST['email'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$nascimento = $_POST['nascimento'] ?? '';
$senha = $_POST['senha'] ?? '';
$confirmar_senha = $_POST['confirmacao'] ?? '';

//Validação
if(empty($nome) || empty($telefone) || empty($email) || empty($senha) || empty($confirmar_senha)) {
    echo json_encode(['status' => 'error', 'message' => 'Preencha todos os campos!']);
    exit;
}

if($senha != $confirmar_senha){
    echo json_encode(['status' => 'error', 'message' => 'As senhas estão diferentes!']);
    exit;
}

// Verificação de e-mail existente
$sql = "SELECT COUNT(*) FROM usuario WHERE dscEmailUsu = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$email]);
if ($stmt->fetchColumn() > 0) {
    echo json_encode(['status' => 'error', 'message' => 'E-mail já cadastrado!']);
    exit;
}

//Processamento dos dados
$telefone = preg_replace('/\D/', '', $telefone);
$cpf = preg_replace('/\D/', '', $cpf);


//Inserção dos dados
$sql = "INSERT INTO usuario(nomUsu, dscEmailUsu, datNascUsu, dscSenhaUsu, numTelefUsu, numCpfUsu, tipo_usuario)
        VALUES(?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$nome, $email, $nascimento, password_hash($senha, PASSWORD_DEFAULT), $telefone, $cpf, 'usuario']);

echo json_encode(['status' => 'success', 'message' => 'Usuário cadastrado com sucesso!']);

?>