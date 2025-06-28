<?php
// Inclui apenas a conexão, não o loginBD
include("../paginas/conexao.php");

// Consulta SQL melhorada
$sql = "SELECT * FROM produto ORDER BY dscProdt ASC";
$result = $conn->query($sql);

// Verifica se há erros na consulta
if (!$result) {
    die("Erro na consulta: " . $conn->error);
}
?>

<div class="table-responsive">
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Estoque</th>
                    <th>Valor</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['idProdt']) ?></td>
                        <td><?= htmlspecialchars($row['dscProdt']) ?></td>
                        <td><?= htmlspecialchars($row['dscDetalProdt']) ?></td>
                        <td><?= $row['qtdAtualEstqProdt'] ?></td>
                        <td>R$ <?= number_format($row['valProdt'], 2, ',', '.') ?></td>
                        <td>
                            <?php if (!empty($row['urlImagemProdt'])): ?>
                                <img src="<?= htmlspecialchars($row['urlImagemProdt']) ?>" width="80" class="img-thumbnail">
                            <?php else: ?>
                                <span class="text-muted">Sem imagem</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="editarProduto.php?id=<?= $row['idProdt'] ?>" class="btn btn-sm btn-primary">Editar</a>
                                <form action="produtoController.php" method="POST" class="d-inline">
                                    <input type="hidden" name="idProdt" value="<?= $row['idProdt'] ?>">
                                    <button type="submit" name="acao" value="excluir" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Nenhum produto cadastrado.</div>
    <?php endif; ?>
</div>

<?php
// Fecha a conexão
$conn->close();
?>