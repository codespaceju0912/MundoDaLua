<?php
$stmt = $conn->query("SELECT * FROM produto ORDER BY idProdt DESC");
$produtos = $stmt->fetchAll();
?>

<div class="table-responsive">
    <?php if (count($produtos) > 0): ?>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th class="text-end">Preço</th>
                    <th class="text-center">Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['idProdt']) ?></td>
                        <td>
                            <?php if (!empty($row['urlImagemProdt'])): ?>
                                <img src="../img/<?= htmlspecialchars($row['urlImagemProdt']) ?>" width="50" class="img-thumbnail">
                            <?php else: ?>
                                <div class="img-thumbnail d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:#f5f5f5;color:#888;">
                                    <i class="bi bi-image"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['dscProdt']) ?></td>
                        <td class="text-end">R$ <?= number_format($row['valProdt'], 2, ',', '.') ?></td>
                        <td class="text-center"><?= $row['qtdAtualEstqProdt'] ?></td>
                            
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="admProd.php?editar=<?= $row['idProdt'] ?>" class="btn btn-sm btn-primary">Editar</a>
                                <a href="admProd.php?excluir=<?= $row['idProdt'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Nenhum produto cadastrado.</div>
    <?php endif; ?>
</div>