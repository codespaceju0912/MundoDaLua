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
// Vendas mensais (agrupadas por mês)
//$vendasMensais = $conexao->query("
//    SELECT 
//        MONTH(datPedido) as mes, 
//        COUNT(*) as total_pedidos,
//        SUM(
//           SELECT SUM(quantidade * preco) 
//            FROM pedidoitem 
//            WHERE pedidoitem.idPedido = pedido.idPedido
//        ) as valor_total
//    FROM pedido
//    WHERE YEAR(datPedido) = YEAR(CURDATE())
//    GROUP BY MONTH(datPedido)
//")->fetch_all(MYSQLI_ASSOC);

// Produtos mais vendidos (top 5)
//$produtosMaisVendidos = $conexao->query("
//    SELECT 
//        p.idProduto,
//        p.nomeProduto,
//        SUM(pi.quantidade) as total_vendido
//    FROM pedidoitem pi
//    JOIN produto p ON pi.idProduto = p.idProduto
//    GROUP BY p.idProduto, p.nomeProduto
//    ORDER BY total_vendido DESC
//    LIMIT 5
//")->fetch_all(MYSQLI_ASSOC);

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