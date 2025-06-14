<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/telaCarrinho.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="../js/base.js" defer></script>
    <title>Carrinho</title>
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
            <button id="botaoPesquisar"><img src="../img/lupaBranca.png" alt="" id="imagemLupa"></button>
        </section>

        <section id="bloco_perfil">
            <img src="../img/perfil.png" alt="" id="imgperfil">
            <h3>Faça <a href="paginas/login.html"><span id="avisoPerfil">LOGIN</span></a> <br>ou <br><a href="paginas/cadastro.html"><span id="avisoPerfil">CADASTRE-SE</span></a></h3>
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
                <li><a class="dropdown-item" href="topper.html">Personalizados</a></li>
                <li><a class="dropdown-item" href="quadro.html">Fotos</a></li>
                <li><a class="dropdown-item" href="marcadores.html">Papelaria</a></li>
                <li><a class="dropdown-item" href="fotos.html">Edição de fotos</a></li>
                <li><a class="dropdown-item" href="caixas.html">Caixinhas personalizadas</a></li>
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
        <section id="carrinhoMain">
            <div><img src="../img/Icon_Carrinho_main.png" alt="" id="imgcarrinho"></div>
            <h3>Carrinho</h3>

        </section>

        <article>
            <div>
                <h4>Quadro MDF</h4>
                <img src="../img/mdf.jpeg" alt="">
            </div>
            <div>
                <p>Total:</p>
                <h3>R$ 60,00</h3>
                <p>Quantidade: 1</p>
                <div>
                    <button>
                        <p>Comprar</p>
                    </button>
                </div>
            </div>
            <div id="divLixeira">
                <img src="../img/excluir.png" alt="" id="lixeira">
            </div>

        </article>
        <article>
            <div>
                <h4>Topper de bolo</h4>
                <img src="../img/topper.png" alt="">
            </div>
            <div>
                <p>Total:</p>
                <h3>R$ 15,00 - R$ 25,00</h3>
                <p>Quantidade: 1</p>
                <div>
                    <button>
                        <p>Comprar</p>
                    </button>
                </div>
            </div>
            <div id="divLixeira">
                <img src="../img/excluir.png" alt="" id="lixeira">
            </div>
        </article>
        <article>
            <div>
                <h4>Marca páginas magnéticos</h4>
                <img src="../img/marcaPg.png" alt="">
            </div>
            <div>
                <p>Total:</p>
                <h3>R$ 1,50</h3>
                <p>Quantidade: 1</p>
                <div>
                    <button>
                        <p>Comprar</p>
                    </button>
                </div>
            </div>
            <div id="divLixeira">
                <img src="../img/excluir.png" alt="" id="lixeira">
            </div>
        </article>
        <article>
            <div>
                <h4>Edição e impressão de fotos</h4>
                <img src="../img/foto.jpeg" alt="">
            </div>
            <div>
                <p>Total:</p>
                <h3>R$ 10,80</h3>
                <p>Quantidade: 1</p>
                <div>
                    <button>
                        <p>Comprar</p>
                    </button>
                </div>
            </div>
            <div id="divLixeira">
                <img src="../img/excluir.png" alt="" id="lixeira">
            </div>
        </article>
        <article>
            <div>
                <h4>Caixinhas personalizadas</h4>
                <img src="../img/caixa.jpg" alt="">
            </div>
            <div>
                <p>Total:</p>
                <h3>Personalizar</h3>
                <p>Quantidade: 1</p>
                <div>
                    <button>
                        <p>Comprar</p>
                    </button>
                </div>
            </div>
            <div id="divLixeira">
                <img src="../img/excluir.png" alt="" id="lixeira">
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