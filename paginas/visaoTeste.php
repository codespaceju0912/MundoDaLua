<?php
include("conexao.php");
session_start();

if (!isset($_GET['id'])) {
    die("Produto não encontrado.");
}

$id = $_GET['id'];

$sql = "SELECT * FROM produto WHERE idProdt = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado.");


}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visão Geral</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/visaoGeral.css">
    <script src="../js/base.js" defer></script>
    <script src="../js/vgmdf.js" defer></script>
</head>
<body>
    
    <header>
        <section id="bloco_mundoDaLua" onclick="goSobre()">
            <h1 id="grafica">Gráfica</h1>
            <h1 id="mundodalua">MUNDO DA LUA </h1>
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
            <h3>Faça <a href="login.php"><span id="avisoPerfil">LOGIN</span></a> <br>ou <br><a
                    href="cadastro.php"><span id="avisoPerfil">CADASTRE-SE</span></a></h3>

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
            <h3 id="produto"><?= $produto['dscProdt'];?></h3>
            <figure >
                <img src=<?= $produto['urlImagemProdt']?> alt="" id="img">
            </figure>
            <h3 id="preco">R$<?= $produto['valProdt'];?></h3>
           <h2 id="h2_descricao">Descrição</h2>
           <p id="p_descricao"><?= $produto['dscDetalProdt'];?></p>
        </article>
        <article>
            <form action="finalizarCompra.php?" method="post" >
            <h3 id="personalizacao">Personalização</h3>
            <input type="hidden" name="idProduto" value="<?= $produto['idProdt']?>">
            <textarea name="personalizacao" id="personalizacao" placeholder="Quero que meu topo de bolo seja da Moana..." class="text_area"></textarea>
            <h2 id="palavra_quantidade">Quantidade <input type="number" name="quantidade" id="quantidade" min="1" max="100" required></h2>
            <a href="finalizarCompra.php?id"><button class="botoes" type="submit">Compra</button></a>
            <button class="botoes" onclick="goCarrinho()">Adicionar ao carrinho</button>
            </form> 

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