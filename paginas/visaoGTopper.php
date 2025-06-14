<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar pedido do Topper de bolo</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/finalizaTopper.css">
    <link rel="stylesheet" href="../css/visaoGTopper.css">
    <script src="../js/base.js" defer></script>
    <script src="../js/vgTopper.js" defer></script>
</head>
<body>
    <header>
        <section id="bloco_nome" onclick="goSobre()">
            <h1 id="grafica">Gráfica</h1>
            <h1 id="mundodalua">MUNDO DA LUA</h1>
        </section>
        <section id="bloco_pesquisa">
            <input  id="barradepesquisa" class="montserrat" type="text" placeholder="Encontre aqui o melhor produto para você">
            <button id="botaoPesquisar"><img src="../img/lupaBranca.png" alt="" id="imagemLupa"></button>
        </section>
        <section class="usuario">
            <img src="../img/usuario.png">
            <p>Faça o <a href="../paginas/login.php">LOGIN</a> ou <a href="../paginas/cadastro.php">CADASTRE-SE</a></p>
        </section>
        <section class="carrinho" onclick="goCarrinho()">
            <a href="../paginas/telaCarrinho.php"><img src="../img/carrinho.png"></a>
            <p><a href="..paginas/telaCarrinho.php">Carrinho</a></p>
        </section>
    </header> 
    <nav>
        <section id="corCategoria">
            <p>Categorias</p>
            <img src="../img/setaMenu.png" alt="">
        </section>
        <section class="palavrasNav" onclick="goTela()">
            <p>Produtos</p>
        </section>
        <section class="palavrasNav" onclick="goPedidos()">
            <p>Acompanhar Pedidos</p>
        </section>
    </nav>
    <article class="main">   
        <article class="box">
            <h2>Topper de bolo</h2>
            <img src="../img/topper.png" alt="Topper de bolo">
            <h4>R$15,00 - R$25,00</h4>
            <h3>Descrição</h3>
            <p class="description">
                Topper de bolo : 15,00 sem a montagem e 25,00 com a montagem. Um lindo e criativo topo de bolo, personalizável do jeito que você quiser para decorar seu bolo e trazer lembranças bonitas para um momento especial.           </p>
        </article>
        <article class="box personaliza">
            <h2>Personalização</h2>
            <textarea name="" id="" placeholder="Ex: Quero que o topper de bolo seja da personagem do filme moana..."></textarea>
            <section class="quanti">
                <label>Quantidade:</label>
                <input type="number" min="1" value="1">
            </section>  
            <a href="../paginas/FinalizarPedidoTopper.php" role="button"><button class="submit-btn compra-btn">Compra</button></a>  
            <button class="submit-btn carrinho-btn" onclick="goCarrinho()">Adicionar ao carrinho</button>    
        </article>
        
    </article>
    <footer style="position: relative;">
        <section id="preRodape">
        </section>
        <section id="rodape">
            <section>
                <h3>Fale conosco</h3>
                <p>Tell: (27) 99201-0821</p>
                <p>E-mail: omundodaluaservicosdigitais@gmail.com</p>
            </section>
            <section>
                <h3>Redes sociais</h3>
                <section class="redessociais">
                    <img src="../img/instagram.png" alt="">
                    <p>@omundodaluaservicosdigitais</p>
                </section>
            </section>
            <section>
                <h3>Área do Cliente</h3>
                <a href="../paginas/login.php">Login</a><br>
                <a href="../paginas/cadastro.php">Cadastra-se</a><br>
                <a href="../paginas/telaPedidos.php">Meus pedidos</a>
            </section>
            <section>
                <h3>Sobre Nós</h3>
                <a href="../paginas/sobreaEmpresa.php">Sobre a Empresa</a>
            </section>
        </section>
    </footer> 
</body>
</html>