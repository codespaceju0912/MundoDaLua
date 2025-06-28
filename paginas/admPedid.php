<?php
// Inicie a sessão primeiro
session_start();

// Verifique se o usuário está logado
if(!isset($_SESSION['idUsu'])) {
    header("Location: login.php");
    exit;
}

// Só então inclua a conexão
include("../paginas/conexao.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Pedidos - ADM</title>
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

    <main>
        <h2 id="title"> Pedidos Recebidos</h2>

        <!-- Campo de busca por cliente e filtro por status -->
        <input type="text" id="buscarPedido" placeholder="Buscar por cliente ou produto...">

        <select id="filtroStatus">
            <option value="">Todos os Status</option>
            <option value="Aguardando">Aguardando</option>
            <option value="Em Produção">Em Produção</option>
            <option value="Enviado">Enviado</option>
            <option value="Entregue">Entregue</option>
        </select>
        
        <!-- Tabela de pedidos-->
        <table id="tabelaPedidos">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Valor</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <!-- Pedidos serão inseridos aqui via JS -->
            </tbody>
        </table>
    </main>

    <script src="../js/admPedid.js" defer></script>
</body>
</html>