<?php
session_start();
require '../paginas/auth_admin.php';

include("paginas/conexao.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($conn)) {
    die("Erro: Conexão com o banco de dados não estabelecida");
}

// Consultas ao banco de dados
$totalUsuarios = $conn->query("SELECT COUNT(*) as total FROM usuario")->fetch(PDO::FETCH_ASSOC)['total'];
$totalProdutos = $conn->query("SELECT COUNT(*) as total FROM produto")->fetch(PDO::FETCH_ASSOC)['total'];
$totalPedidos = $conn->query("SELECT COUNT(*) as total FROM pedido")->fetch(PDO::FETCH_ASSOC)['total'];


// Vendas mensais (agora com dados reais)
$vendasMensais = $conn->query("
    SELECT 
        MONTH(datPedido) as mes, 
        COUNT(*) as total_pedidos, 
        SUM(valProdt * qtdProdt) as valor_total
    FROM pedido p
    JOIN produto pr ON p.idProdt = pr.idProdt
    GROUP BY MONTH(datPedido)
    ORDER BY mes
")->fetchAll(PDO::FETCH_ASSOC);

// Produtos mais vendidos (com dados reais)
$produtosMaisVendidos = $conn->query("
    SELECT 
        p.idProdt, 
        p.dscProdt, 
        SUM(pe.qtdProdt) as total_vendido,
        SUM(pe.qtdProdt * p.valProdt) as valor_total
    FROM pedido pe
    JOIN produto p ON pe.idProdt = p.idProdt
    GROUP BY p.idProdt, p.dscProdt
    ORDER BY total_vendido DESC
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);
// Produtos com estoque baixo (alerta importante)
$estoqueBaixo = $conn->query("
    SELECT 
        idProdt, 
        dscProdt, 
        qtdAtualEstqProdt, 
        qtdMinEstqProdt
    FROM produto
    WHERE qtdAtualEstqProdt < qtdMinEstqProdt
")->fetchAll(PDO::FETCH_ASSOC);

// Pedidos pendentes (status importante)
$pedidosPendentes = $conn->query("
    SELECT 
        pe.idPedido, 
        pe.datPedido, 
        pe.dscStatusPedido, 
        u.nomUsu as nome_cliente, 
        p.dscProdt,
        pe.qtdProdt,
        p.valProdt
    FROM pedido pe
    JOIN produto p ON pe.idProdt = p.idProdt
    JOIN usuario u ON pe.idUsuario = u.idUsu
    WHERE pe.dscStatusPedido = 'Aguardando pagamento'
    ORDER BY pe.datPedido DESC
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);

foreach ($pedidosPendentes as &$pedido) {
    try {
        // Formatação da data
        if (!empty($pedido['datPedido'])) {
            $pedido['datPedido_formatada'] = date('d/m/Y H:i', strtotime($pedido['datPedido']));
        } else {
            $pedido['datPedido_formatada'] = 'Data não disponível';
        }
        
        // Cálculo do valor total
        $quantidade = $pedido['qtdProdt'] ?? 0;
        $valorUnitario = $pedido['valProdt'] ?? 0;
        $pedido['valor_total'] = number_format($quantidade * $valorUnitario, 2, ',', '.');
        
        // Formatação adicional
        $pedido['produto_info'] = htmlspecialchars($pedido['dscProdt'] ?? 'Produto não especificado') . 
                                 ' (Quantidade: ' . ($quantidade) . ')';
        
    } catch (Exception $e) {
        error_log("Erro ao formatar pedido ID {$pedido['idPedido']}: " . $e->getMessage());
        continue;
    }
}

$pedidos = [
    // Janeiro
    ['2025-01-05', 'Concluído', 1, 1, 2],
    ['2025-01-12', 'Concluído', 2, 3, 1],
    ['2025-01-18', 'Concluído', 3, 2, 3],

    //Fevereiro
    ['2025-02-03', 'Concluído', 4, 1, 1],
    ['2025-02-15', 'Concluído', 5, 4, 2],

    // Março
    ['2025-03-10', 'Concluído', 1, 5, 1],
    ['2025-03-22', 'Concluído', 2, 2, 4],

];

try {
    $conn->beginTransaction(); // Inicia transação
    
    $sql = "INSERT INTO pedido (datPedido, dscStatusPedido, idUsuario, idProdt, qtdProdt) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    foreach ($pedidos as $pedido) {
        $stmt->execute($pedido);
    }
    
    $conn->commit(); // Confirma a transação
    echo count($pedidos) . " pedidos inseridos com sucesso!";
} catch (PDOException $e) {
    $conn->rollBack(); // Em caso de erro, reverte a transação
    echo "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visão Geral - ADM </title>
    <link rel="stylesheet" href="../css/admVisaoGeral.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
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
    
    <main>
        <h2>Painel de Visão Geral</h2>

        <<!-- Cards de resumo -->
        <section id="dashboard-cards">
            <div class="card">
                <h3>Total de Usuários</h3>
                <p id="totalUsuarios">0</p>
            </div>
            <div class="card">
                <h3>Total de Produtos</h3>
                <p id="totalProdutos">0</p>
            </div>
            <div class="card">
                <h3>Total de Pedidos</h3>
                <p id="totalPedidos">0</p>
            </div>
        </section>

        <!-- Gráficos -->
        <section class="grafico-container">
            <h3 class="grafico-titulo">Vendas Mensais (R$)</h3>
            <canvas id="graficoVendas"></canvas>
        </section>

        <section class="grafico-container">
            <h3 class="grafico-titulo">Produtos Mais Vendidos</h3>
            <canvas id="graficoProdutos"></canvas>
        </section>
    </main>

    <script src="../js/admVisaoGeral.js" defer></script>
</body>

<script>
    // Dados para os gráficos
    const dadosDashboard = {
        totalUsuarios: <?= $totalUsuarios ?>,
        totalProdutos: <?= $totalProdutos ?>,
        totalPedidos: <?= $totalPedidos ?>,
        vendasMensais: <?= json_encode($vendasMensais) ?>,
        produtosMaisVendidos: <?= json_encode($produtosMaisVendidos) ?>
    };
</script>
</html>