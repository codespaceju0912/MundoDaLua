<?php
session_start();
include("../paginas/conexao.php");

// Verifica se é um adm logado
if(!isset($_SESSION['admin_logado'])) {
    echo json_encode(['status' => 'error', 'message' => 'Acesso não autorizado!']);
    exit;
}

$id = $_POST['idUsu'] ?? null;
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

if(!empty($senha) && $senha != $confirmar_senha) {
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

try {
    if($id) {
        // Atualização
        if(!empty($senha)) {
            $sql = "UPDATE usuario SET nomUsu = ?, dscEmailUsu = ?, datNascUsu = ?, dscSenhaUsu = ?, 
                    numTelefUsu = ?, numCpfUsu = ? WHERE idUsu = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nome, $email, $nascimento, password_hash($senha, PASSWORD_DEFAULT), 
                          $telefone, $cpf, $id]);
        } else {
            $sql = "UPDATE usuario SET nomUsu = ?, dscEmailUsu = ?, datNascUsu = ?, 
                    numTelefUsu = ?, numCpfUsu = ? WHERE idUsu = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nome, $email, $nascimento, $telefone, $cpf, $id]);
        }
        echo json_encode(['status' => 'success', 'message' => 'Usuário atualizado com sucesso!']);
    } else {
        // Inserção
        if(empty($senha)) {
            echo json_encode(['status' => 'error', 'message' => 'Senha é obrigatória para novo usuário!']);
            exit;
        }
        
        $sql = "INSERT INTO usuario(nomUsu, dscEmailUsu, datNascUsu, dscSenhaUsu, numTelefUsu, numCpfUsu, tipo_usuario)
                VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $email, $nascimento, password_hash($senha, PASSWORD_DEFAULT), 
                       $telefone, $cpf, 'usuario']);
        echo json_encode(['status' => 'success', 'message' => 'Usuário cadastrado com sucesso!']);
    }
} catch(PDOException $e) {
    if($e->getCode() == 23000) { // Código para violação de chave única (email duplicado)
        echo json_encode(['status' => 'error', 'message' => 'E-mail já cadastrado!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro no banco de dados: ' . $e->getMessage()]);
    }
}

?>