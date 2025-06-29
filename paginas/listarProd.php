<?php
$sql = "SELECT * FROM produto ORDER BY idProdt DESC";
$result = $conn->query($sql);
?>

<div class="table-responsive">
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['idProdt']) ?></td>
                        <td>
                            <?php if (!empty($row['urlImagemProdt'])): ?>
                                <img src="../img/<?= htmlspecialchars($row['urlImagemProdt']) ?>" width="50" class="img-thumbnail">
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['dscProdt']) ?></td>
                        <td>R$ <?= number_format($row['valProdt'], 2, ',', '.') ?></td>
                        <td><?= $row['qtdAtualEstqProdt'] ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="admProd.php?editar=<?= $row['idProdt'] ?>" class="btn btn-sm btn-primary">Editar</a>
                                <a href="admProd.php?excluir=<?= $row['idProdt'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</a>
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