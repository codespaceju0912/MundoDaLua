<?php include("../php/loginBD.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar/Alterar/Excluir Produto</title>
    <link rel="stylesheet" href="../css/admProd.css">
    <link rel="stylesheet" href="../css/style.css">
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
        <div id="container">
            <h1>Painel de Produtos</h1>
            
            <section>
                <form id="formProduto">
                    <h2>Cadastrar Novo Produto</h2>
                            
                    <label for="nomeProd">Nome do Produto:</label>
                    <input type="text" id="nomeProd" required>
                            
                    <label for="precoProd">Preço (R$):</label>
                    <input type="number" id="precoProd" step="0.01" required>
                            
                    <label for="descricaoProd">Descrição:</label>
                    <input type="text" id="descricaoProd" required>
                            
                    <label for="categoriaProd">Categoria:</label>
                    <select id="categoriaProd" required>
                        <option value="">Selecione...</option>
                        <option value="Fotos">Fotos</option>
                        <option value="Papelaria">Papelaria</option>
                        <option value="Personalizados">Personalizados</option>
                    </select>
                            
                    <label for="estoqueProd">Quantidade em Estoque:</label>
                    <input type="number" id="estoqueProd" min="0" value="1" required>
                            
                    <label for="imagemProd">Imagem do Produto:</label>
                    <input type="file" id="imagemProd" accept="image/*">
                            
                    <div class="btn-group">
                        <button class="btnCad">Cadastrar</button>
                        <button class="btnAlt">Alterar</button>
                        <button class="btnExc">Excluir</button>
                    </div>
                </form>

                <section id="prod-lista">
                    <h3>Produtos Cadastrados</h3>
                    <section class="prod-item" id="listaProdutos">

                        <div>
                        <img src="../img/marcaPg.png" alt="marca pagina">
                        <div class="prod-info">
                            <h4>Marca Páginas Magnéticos</h4>
                            <p><strong>R$ 1,50 - R$ 3,00</strong></p>
                        </div>
                        </div>

                        <div>
                        <img src="../img/foto.jpeg">
                        <div class="prod-info">
                            <h4>Edição e impressão de fotos </h4>
                            <p><strong>R$1,75 - R$10,80</strong></p>
                        </div>
                        </div>
                        
                        <div>
                            <img src="../img/mdf.jpeg">
                            <div class="prod-info">
                                <h4>Quadro MDF com foto ou frase</h4>
                                <p><strong>R$60,00</strong></p>
                            </div>
                        </div>

                        <div>
                            <img src="../img/caixa.jpg">
                            <div class="prod-info">
                                <h4>Caixinhas Personalizadas</h4>
                                <p><strong>R$ 15,00 -</strong></p>
                            </div>
                        </div>
                    </section>

                    <div class="prod-acoes">
                        <button class="edit">Editar</button>
                        <button class="exc">Excluir</button>
                    </div>
                </section> 
            </section> 
        </div>
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
            <a href="..paginas/telaPedidos.php">Meus pedidos</a>
        </div>
        <div>
            <h3>Sobre Nós</h3>
            <a href="../paginas/sobreaEmpresa.php">Sobre a Empresa</a>
        </div>

    </footer>

    <!--js para adicionar os produtos-->
    <script src="../js/admProd.js"></script>

    <script src="/js/produtos.js"></script>

</body>
</html>