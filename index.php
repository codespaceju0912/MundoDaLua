<?php
include("paginas/conexao.php");
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql = "SELECT dscProdt FROM produto";
$stmt = $conn->prepare($sql);
$stmt->execute();
$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
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
            <?php
            if(!isset($_SESSION['idUsu'], $_SESSION['nomeUsu'])){ ?>
            <h3>Faça <a href="paginas/login.php"><span id="avisoPerfil">LOGIN</span></a> <br>ou <br><a
                    href="paginas/cadastro.php"><span id="avisoPerfil">CADASTRE-SE</span></a></h3>

            <?php } else {?>

                <h3>Olá, <?= $_SESSION['nomeUsu']?><br> <a href="/MundoDaLua/paginas/logout_usuario.php" >SAIR</a></h3> 
                
                
            <?php } ?>
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
       <?php foreach($dados AS $linha){?>
        <article>
            <figure>
                <img src="img/logo.png" alt="">
            </figure>
            <p><?=$linha['dscProdt'];?></p>
            <button>
                <p>Saiba mais</p>
            </button>
        </article>
        <?php }?>


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