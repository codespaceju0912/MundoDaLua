<?php 
session_start();
include('conexao.php');
$sql = "SELECT p.idPedido, p.idProdt, prod.dscProdt, p.dscStatusPedido, p.qtdProdt 
        FROM pedido p 
        INNER JOIN produto prod ON p.idProdt = prod.idProdt 
        WHERE p.idUsuario = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION['idUsu']]);
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
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
            <?php
            if(!isset($_SESSION['idUsu'], $_SESSION['nomeUsu'])){ ?>
            <h3>Faça <a href="/MundoDaLua/paginas/login.php"><span id="avisoPerfil">LOGIN</span></a> <br>ou <br><a
                    href="/MundoDaLua/paginas/cadastro.php"><span id="avisoPerfil">CADASTRE-SE</span></a></h3>

            <?php } else {?>

                <h3>Olá, <?= $_SESSION['nomeUsu']?><br> <a href="/MundoDaLua/paginas/logout_usuario.php" >SAIR</a></h3> 
            <?php } ?>
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
        <section class="palavrasNav">
            <p>Acompanhar Pedidos</p>
        </section>
    </nav>
    <main>
        <?php
if (!isset($_SESSION['idUsu'])) {
    echo "<h1>Faça login para poder acompanhar seus pedidos!</h1>";
} else if ((!is_array($pedidos) || count($pedidos) === 0)) {
    echo "<h1>Essa tela serve para acompanhar pedidos, faça já o seu!</h1>";
} else {
    foreach ($pedidos as $pedido) {
        if ($pedido['dscStatusPedido'] == 'Aguardando pagamento') {
            ?>
            <article>
                <div>
                    <h4>Produto</h4>
                    <p><?= $pedido['qtdProdt']?>X <br><?=$pedido['dscProdt'] ?></p>
                </div>
                <div id="statusAguardandoPagamento">
                    <h4>Status do pedido</h4>
                    <h3><?= $pedido['dscStatusPedido'] ?></h3>
                    <div id="avisoAguardando">
                        <p>Isso significa que <br>seu pagamento ainda não<br> consta no nosso sistema.</p>
                    </div>
                </div>
            </article>
            <?php
        } else if ($pedido['dscStatusPedido'] == 'Pronto') { ?>
            <article>
                <div>
                    <h4>Produtos</h4>
                    <p><?= $pedido['dscProdt'] ?></p>
                </div>
                <div id="statusPronto">
                    <h4>Status do pedido</h4>
                    <h3><?= $pedido['dscStatusPedido'] ?></h3>
                    <div id="avisoPronto">
                        <p>Isso significa que <br>seu pedido já está<br> pronto para retirar.</p>
                    </div>
                </div>
            </article>
            <?php
        } else if ($pedido['dscStatusPedido'] == 'Em produção') {
            ?>
            <article>
                <div>
                    <h4>Produtos</h4>
                    <p><?= $pedido['dscProdt'] ?></p>
                </div>
                <div id="statusProducao">
                    <h4>Status do pedido</h4>
                    <h3><?= $pedido['dscStatusPedido'] ?></h3>
                    <div id="avisoProducao">
                        <p>Seu pedido está em produção.</p>
                    </div>
                </div>
            </article>
            <?php
        } else if ($pedido['dscStatusPedido'] == 'Finalizado') {
            ?>
            <article>
                <div>
                    <h4>Produtos</h4>
                    <p><?= $pedido['dscProdt'] ?></p>
                </div>
                <div id="statusFinalizado">
                    <h4>Status do pedido</h4>
                    <h3><?= $pedido['dscStatusPedido'] ?></h3>
                    <div id="avisoFinalizado">
                        <p>Pedido finalizado e pronto.</p>
                    </div>
                </div>
            </article>
            <?php
        }
    }
}
?>

            
        
        

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