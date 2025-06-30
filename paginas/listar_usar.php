<?php
session_start();
include("../paginas/conexao.php");

// Verifica se é admin
if(!isset($_SESSION['eh_admin'])) {
    header("Location: ../paginas/login.php");
    exit;
}

// Processar exclusão
if(isset($_GET['excluir'])) {
    try {
        $stmt = $conn->prepare("DELETE FROM usuario WHERE idUsu = ?");
        $stmt->execute([$_GET['excluir']]);
        header("Location: admUsuar.php?sucesso=3"); // 3 para sucesso de exclusão
        exit;
    } catch(PDOException $e) {
        header("Location: admUsuar.php?erro=1");
        exit;
    }
}

$sql = "SELECT idUsu, nomUsu, dscEmailUsu, datNascUsu, numTelefUsu, numCpfUsu FROM usuario";
$stmt = $conn->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Mensagens de sucesso/erro
$mensagem = '';
if(isset($_GET['sucesso'])) {
    switch($_GET['sucesso']) {
        case 1: $mensagem = '<div class="alert alert-success">Usuário cadastrado com sucesso!</div>'; break;
        case 2: $mensagem = '<div class="alert alert-success">Usuário atualizado com sucesso!</div>'; break;
        case 3: $mensagem = '<div class="alert alert-success">Usuário excluído com sucesso!</div>'; break;
    }
} elseif(isset($_GET['erro'])) {
    $mensagem = '<div class="alert alert-danger">Ocorreu um erro. Por favor, tente novamente.</div>';
}
?>

<div class="table-responsive">

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Nascimento</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>

                <tr>
                    <td><?= htmlspecialchars($usuario['idUsu']) ?></td>
                    <td><?= htmlspecialchars($usuario['nomUsu']) ?></td>
                    <td><?= htmlspecialchars($usuario['dscEmailUsu']) ?></td>
                    <td><?= date('d/m/Y', strtotime($usuario['datNascUsu'])) ?></td>
                    <td><?= formatarTelefone(htmlspecialchars($usuario['numTelefUsu']))?></td>
                    <td><?= formatarCPF(htmlspecialchars($usuario['numCpfUsu']))?></td>
                    <td><?= htmlspecialchars($usuario['tipoUsu']) ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="admUsuar.php?editar=<?= $usuario['idUsu'] ?>" class="btn btn-primary btn-sm">Editar</a>
                            <a href="listar_usuar.php?excluir=<?= $usuario['idUsu'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php

// Função para formartar telefone
function formatarTelefone($telefone) {
    $telefone = preg_replace('/\D/', '', $telefone);
    if (strlen($telefone) === 11) {
        return preg_replace('/(d{2})(\d{5})(\d{4})/', '($1) $2-$3', $telefone);
    }
    return $telefone;
}

// Função para formatar CPF
function formatarCPF($cpf){
    $cpf = preg_replace('/\D/', '', $cpf);
    if (strlen($cpf) === 11) {
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
    }
    return $cpf;
}

?>