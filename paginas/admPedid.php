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

        <section id="bloco_pesquisa">
            <input id="barradepesquisa" class="montserrat" type="text"
                placeholder="Encontre aqui o melhor produto para você">
            <button id="botaoPesquisar"><img src="/img/lupaBranca.png" alt="" id="imagemLupa"></button>
        </section>

        <section id="bloco_perfil">
            <img src="../img/perfil.png" alt="" id="imgperfil">
            <h3>Faça <a href="../paginas/login.php"><span id="avisoPerfil">LOGIN</span></a> <br>ou <br><a
                    href="../paginas/cadastro.php"><span id="avisoPerfil">CADASTRE-SE</span></a></h3>
        </section>
        <section id="bloco_carrinho" onclick="goCarrinho()">
            <img src="../img/Carrinho.png" alt="" id="imgcarrinho">
            <h3>Carrinho</h3>
        </section>
    </header>
    <nav>

        <div class="btn-group dropend" id="corCategoria">
            <button type="button" class="btn btn-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Categorias
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="topper.php">Personalizados</a></li>
                <li><a class="dropdown-item" href="quadro.php">Fotos</a></li>
                <li><a class="dropdown-item" href="marcadores.php">Papelaria</a></li>
            </ul>
        </div>

        <section class="palavrasNav">
            <p>Produtos</p>
        </section>
        <section class="palavrasNav" onclick="goPedidos()">
            <p>Acompanhar Pedidos</p>
        </section>
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
            <a href="/paginas/login.php">Login</a><br>
            <a href="cadastro.php">Cadastre-se</a><br>
            <a href="telaPedidos.php">Meus pedidos</a>
        </div>
        <div>
            <h3>Sobre Nós</h3>
            <a href="/paginas/sobreaEmpresa.php">Sobre a Empresa</a>
        </div>
    </footer>

    <script src="/js/admPedid.js"></script>
</body>
</html>