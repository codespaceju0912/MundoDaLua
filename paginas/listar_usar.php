<?php
session_start();
include("../paginas/conexao.php");

// Verifica se é admin
if(!isset($_SESSION['admin_logado'])) {
    header("Location: ../paginas/login.php");
    exit;
}

$sql = "SELECT idUsu, nomUsu, dscEmailUsu, datNascUsu, numTelefUsu, numCpfUsu FROM usuario";
$stmt = $conn->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="table-respondive">
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
                            <button class="btn-editar" data-id="<?= $usuario['idUsu'] ?>">Editar</button>
                            <button class="btn-excluir" data-id="<?= $usuario['idUsu'] ?>">Excluir</button>
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
        return preg_replace('/(\s{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
    }
    return $cpf;
}

?>