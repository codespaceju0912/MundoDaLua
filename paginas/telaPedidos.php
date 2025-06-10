<!DOCTYPE html>
<html lang="pt-br">

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/MundoDaLua/css/telaPedidos.css">
    <link rel="stylesheet" href="/MundoDaLua/css/style.css">
    <script src="/MundoDaLua/js/base.js" defer></script>
    <title>Pedidos</title>
</head>

<body>
    <header>
        <section id="bloco_mundoDaLua" onclick="goSobre()">
            <h1 id="grafica">Gráfica</h1>
            <h1 id="mundodalua">MUNDO DA LUA</h1>
        </section>

        <section id="bloco_pesquisa">
            <input id="barradepesquisa" class="montserrat" type="text"
                placeholder="Encontre aqui o melhor produto para você">
            <button id="botaoPesquisar"><img src="/MundoDaLua/img/lupaBranca.png" alt="" id="imagemLupa"></button>
        </section>

        <section id="bloco_perfil">
            <img src="/MundoDaLua/img/perfil.png" alt="" id="imgperfil">
            <h3>Faça <a href="login.php"><span id="avisoPerfil">LOGIN</span></a> <br>ou <br><a href="cadastro.php"><span id="avisoPerfil">CADASTRE-SE</span></a></h3>
        </section>
        <section id="bloco_carrinho" onclick="goCarrinho()">
            <img src="/MundoDaLua/img/Carrinho.png" alt="" id="imgcarrinho">
            <h3>Carrinho</h3>
        </section>
    </header>
    <nav>
        
<div class="btn-group dropend" id="corCategoria">
  <button type="button" class="btn btn-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Categorias 
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="topper.html">Personalizados</a></li>
    <li><a class="dropdown-item" href="quadro.html">Fotos</a></li>
    <li><a class="dropdown-item" href="marcadores.html">Papelaria</a></li>
  </ul>
</div>

        <section class="palavrasNav" onclick="goTela()">
            <p>Produtos</p>
        </section>
        <section class="palavrasNav" onclick="goPedidos()">
            <p>Acompanhar Pedidos</p>
        </section>
    </nav>
    <main>
        <article>
            <div>
                <h4>Produtos</h4>
                <p>1x Quadro MDF</p>
                <p>2x Topper de bolo</p>
                <p>1x Edição de foto</p>
            </div>
            <div id="statusPronto">
                <h4>Status do pedido</h4>
                <h3>Pedido pronto para retirar</h3>
                <div id="avisoPronto">
                    <p>Isso significa que <br>seu pedido já está<br> pronto para retirar.</p>
                </div>
            </div>
        </article>
        <article>
            <div>
                <h4>Produtos</h4>
                <p>1x Quadro MDF</p>
                <p>2x Topper de bolo</p>
                <p>1x Edição de foto</p>
            </div>
            <div id="statusAguardandoPagamento">
                <h4>Status do pedido</h4>
                <h3>Aguardando pagamento</h3>
                <div id="avisoAguardando">
                    <p>Isso significa que <br>seu pagamento ainda não<br> consta no nosso sistema.</p>
                </div>
            </div>
        </article>
        <article>
            <div>
                <h4>Produtos</h4>
                <p>1x Quadro MDF</p>
                <p>2x Topper de bolo</p>
                <p>1x Edição de foto</p>
            </div>
            <div id="statusProducao">
                <h4>Status do pedido</h4>
                <h3>Em produção</h3>
                <div id="avisoProducao">
                    <p>Isso significa que seu pedido<br> esta sendo produzido,<br> e logo ficará pronto.</p>
                </div>
            </div>
        </article>
        
        <article>
            <div>
                <h4>Produtos</h4>
                <p>1x Quadro MDF</p>
                <p>2x Topper de bolo</p>
                <p>1x Edição de foto</p>
            </div>
            <div id="statusFinalizado">
                <h4>Status do pedido</h4>
                <h3>Finalizado</h3>
                <div id="avisoFinalizado">
                    <p>Isso significa que seu pedido<br>já foi retirado. <br> Agradecemos pela preferência.</p>
                </div>
            </div>
        </article>


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
                <a href="https://www.instagram.com/omundodaluaservicosdigitais?igsh=ZXlzZWdlbGE1ZWhq"><img src="../img/instagram.png" alt=""></a>
                <a href="https://www.instagram.com/omundodaluaservicosdigitais?igsh=ZXlzZWdlbGE1ZWhq"><p>@omundodalua<br>servicosdigitais</p></a>
            </section>
        </div>
        <div>
            <h3>Área do Cliente</h3>
            <a href="paginas/login.php">Login</a><br>
            <a href="paginas/cadastro.php">Cadastre-se</a><br>
            <a href="paginas/telaPedidos.php">Meus pedidos</a>
        </div>
        <div>
            <h3>Sobre Nós</h3>
            <a href="paginas/sobreaEmpresa.php">Sobre a Empresa</a>
        </div>

    </footer>
</body>

</html>