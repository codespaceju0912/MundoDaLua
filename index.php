<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Produtos.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/base.js" defer></script>
    <title>Produtos</title>
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
            <button id="botaoPesquisar"><img src="img/lupaBranca.png" alt="" id="imagemLupa"></button>
        </section>

        <section id="bloco_perfil">
            <img src="img/perfil.png" alt="" id="imgperfil">
            <h3>Faça <a href="paginas/login.php"><span id="avisoPerfil">LOGIN</span></a> <br>ou <br><a
                    href="paginas/cadastro.php"><span id="avisoPerfil">CADASTRE-SE</span></a></h3>
        </section>
        <section id="bloco_carrinho" onclick="goCarrinho()">
            <img src="img/Carrinho.png" alt="" id="imgcarrinho">
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

        <section class="palavrasNav">
            <p>Produtos</p>
        </section>
        <section class="palavrasNav" onclick="goPedidos()">
            <p>Acompanhar Pedidos</p>
        </section>
    </nav>
    <main>
        <article>
            <figure>
                <img src="img/topper.png" alt="">
            </figure>
            <p>Topper de bolo</p>
            <a href="paginas/visaoGTopper.php"><button>
                    <p>Saiba mais</p>
                </button></a>
        </article>
        <article>
            <figure>
                <img src="img/mdf.jpeg" alt="">
            </figure>
            <p>Quadro MDF com foto ou frase</p>
            <a href="paginas/visaoGMdf.php"><button>
                    <p>Saiba mais</p>
                </button></a>
        </article>
        <article>
            <figure>
                <img src="img/marcaPg.png" alt="">
            </figure>
            <p>Marcadores de página</p>
            <a href="paginas/visaoGMarcaPg.php"><button>
                    <p>Saiba mais</p>
                </button></a>
        </article>
        <article>
            <figure>
                <img src="img/foto.jpeg" alt="">
            </figure>
            <p>Edição de fotos</p>
            <a href="paginas/visaoGEdtFoto.php"><button>
                    <p>Saiba mais</p>
                </button></a>
        </article>
        <article>
            <figure>
                <img src="img/caixa.jpg" alt="">
            </figure>
            <p>Caixinha personalizada</p>
            <a href="paginas/visaoGCaixa.php"><button>
                    <p>Saiba mais</p>
                </button></a>
        </article>
        <article>
            <figure>
                <img src="img/logo.png" alt="">
            </figure>
            <p>Produto</p>
            <button>
                <p>Saiba mais</p>
            </button>
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
                <a href="https://www.instagram.com/omundodaluaservicosdigitais?igsh=ZXlzZWdlbGE1ZWhq"><img src="img/instagram.png" alt=""></a>
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