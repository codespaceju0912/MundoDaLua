<?php
session_start();
include("conexao.php");


$sql = "SELECT carrinho.idUsu, carrinho.valProdt, carrinho.idProdt, produto.dscProdt, produto.urlImagemProdt, produto.valProdt AS precoOriginal FROM carrinho JOIN produto ON carrinho.idProdt = produto.idProdt WHERE carrinho.idUsu = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION['idUsu']]);
$carrinho = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
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
            <?php
            if(!isset($_SESSION['idUsu'], $_SESSION['nomeUsu'])){ ?>
            <h3>Faça <a href="/MundoDaLua/paginas/login.php"><span id="avisoPerfil">LOGIN</span></a> <br>ou <br><a
                    href="/MundoDaLua/paginas/cadastro.php"><span id="avisoPerfil">CADASTRE-SE</span></a></h3>

            <?php } else {?>

                <h3>Olá, <?= $_SESSION['nomeUsu']?><br> <a href="/MundoDaLua/paginas/logout_usuario.php" >SAIR</a></h3> 
            <?php } ?>
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
        <?php
         if ((!is_array($carrinho) || count($carrinho) === 0)) {
    echo "<h1>Guarde aqui aquele produto que mais se parece com você!</h1>";
} else {
    foreach ($carrinho as $item) { ?>
        <article>
            <div>
                <h4><?= $item['dscProdt']?></h4>
                <img src="<?= $item['urlImagemProdt']?>" alt="">
            </div>
            <div>
                <p>Preço:</p>
                <h3>R$<?= $item['valProdt']?></h3>
                
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
            <?php
        }}?>

        

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