<?php include("../paginas/conexao.php"); 
session_start();
if(!isset($_SESSION['idUsu'], $_SESSION['nomeUsu']) || $_SESSION['idUsu'] != 1){
    echo "<script>alert('Usuário não tem permissão!'); window.location.href = '../paginas/login.php';</script>";
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
                <li><a href="../paginas/admVisaoGeral.php">Início</a></li>
                <li><a href="../paginas/admProd.php">Produtos</a></li>
                <li><a href="../paginasa/dmUsuar.php">Usuários</a></li>
                <li><a href="../paginas/admPedid.php">Pedidos</a></li>
                <li><a href="../paginas/logout.php" >Sair</a></li>
            </ul>
        </div>
        
    </nav>
    
    <main>
        <h2>Painel de Visão Geral</h2>

        <!-- Cards de resumo -->
        <section id="dashboard-cards">
            <div class="card">
                <h3>Total de Usuários</h3>
                <p id="totalUsusarios">0</p>
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
        <section id="graficos">
            <h3>Vendas Mensais</h3>
            <canvas id="graficoVendas" width="400" height="200"></canvas>
        </section>

        <section id="graficos">
            <h3>Produtos Mais Vendidos</h3>
            <canvas id="graficoProdutos" width="400" height="200"></canvas>
        </section>
    </main>

    <footer>

        <div>
            <h3>Fale conosco</h3>
            <p>Tell: (27) 99201-0821</p>
            <p>E-mail: omundodaluaservicos<br>digitais@gmail.com</p>
        </div>
        <div>
            <h3>Redes sociais</h3>
            <section class="redessociais">
                <a href="https://www.instagram.com/omundodaluaservicosdigitais?igsh=ZXlzZWdlbGE1ZWhq"><img src="/img/instagram.png" alt=""></a>
                <a href="https://www.instagram.com/omundodaluaservicosdigitais?igsh=ZXlzZWdlbGE1ZWhq"><p>@omundodalua<br>servicosdigitais</p></a>
            </section>
        </div>
        <div>
            <h3>Área do Cliente</h3>
            <a href="../paginas/login.php">Login</a><br>
            <a href="../paginas/cadastro.php">Cadastre-se</a><br>
            <a href="../paginas/telaPedidos.php">Meus pedidos</a>
        </div>
        <div>
            <h3>Sobre Nós</h3>
            <a href="../paginas/sobreaEmpresa.php">Sobre a Empresa</a>
        </div>
    </footer>

    <script src="/js/admVisaoGeral.js"></script>
</body>
</html>