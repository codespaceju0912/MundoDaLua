<?php
require '../paginas/auth_admin.php';
include("conexao.php"); 

// Consulta para obter os pedidos com JOIN para pegar nome do usuário e produto
$query = "SELECT 
            p.idPedido,
            p.datPedido,
            p.dscStatusPedido,
            p.idUsuario,
            p.idProdt,
            p.qtdProdt,
            u.nomUsu as cliente,
            pr.dscProdt as produto,
            pr.valProdt as valor_unitario,
            (p.qtdProdt * pr.valProdt) as valor_total
          FROM pedido p
          JOIN usuario u ON p.idUsuario = u.idUsu
          JOIN produto pr ON p.idProdt = pr.idProdt
          ORDER BY p.datPedido DESC";

$pedidos = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Pedidos</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admPedid.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="../js/base.js" defer></script>
</head>
<body>
<header>
        <section id="bloco_mundoDaLua">
            <h1 id="grafica">Gráfica</h1>
            <h1 id="mundodalua">MUNDO DA LUA</h1>
        </section>
    </header>

    <nav>
        <div class="admin-nav">
            <ul>
                <li><a href="/MundoDaLua/paginas/admVisaoGeral.php">Início</a></li>
                <li><a href="/MundoDaLua/paginas/admProd.php">Produtos</a></li>
                <li><a href="/MundoDaLua/paginas/admUsuar.php">Usuários</a></li>
                <li><a href="/MundoDaLua/paginas/admPedid.php">Pedidos</a></li>
                <li><a href="/MundoDaLua/paginas/logout.php" >Sair</a></li>
            </ul>
        </div>
        
    </nav>

    <main class="container mt-4">
        <h2 iclass="mb-4"> Pedidos Recebidos</h2>

        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" id="buscarPedido" class="form-control" placeholder="Buscar por cliente ou produto...">
            </div>

            <div class="col-md-4">
                <select id="filtroStatus" class="form-select">
                    <option value="">Todos os Status</option>
                    <option value="Aguardando pagamento">Aguardando pagamento</option>
                    <option value="Em produção">Em produção</option>
                    <option value="Pronto">Enviado</option>
                    <option value="Finalizado">Entregue</option>
                </select>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tabelaPedidos">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Quantidade</th>
                        <th>Valor Unitário</th>
                        <th>Valor Total</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?= $pedido['idPedido'] ?></td>
                            <td><?= htmlspecialchars($pedido['cliente']) ?></td>
                            <td><?= htmlspecialchars($pedido['produto']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($pedido['datPedido'])) ?></td>
                            <td>
                                <span class="status-aguardando">
                                    <?= htmlspecialchars($pedido['dscStatusPedido']) ?>
                                </span>
                            </td>
                            <td><?= $pedido['qtdProdt'] ?></td>
                            <td>R$ <?= number_format($pedido['valor_unitario'], 2, ',', '.') ?></td>
                            <td class="valor-total">R$ <?= number_format($pedido['valor_total'], 2, ',', '.') ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary btn-editar" data-id="<?= $pedido['idPedido'] ?>">
                                    <i class="bi bi-pencil"></i> Editar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal de Edição -->
        <div class="modal fade" id="modalEditarPedido" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Pedido #<span id="pedidoId"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditarPedido">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" id="pedidoStatus">
                                    <option value="Aguardando pagamento">Aguardando pagamento</option>
                                    <option value="Em produção">Em produção</option>
                                    <option value="Pronto">Enviado</option>
                                    <option value="Finalizado">Entregue</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quantidade</label>
                                <input type="number" class="form-control" name="quantidade" id="pedidoQuantidade" min="1">
                            </div>
                            <input type="hidden" name="idPedido" id="pedidoIdHidden">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="btnSalvarPedido">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/admPedid.js" defer></script>
</body>
</html>