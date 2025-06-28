<?php
include("conexao.php");
session_start();

if (!isset($_GET['id'])) {
    die("Produto não encontrado.");
}

$id = $_GET['id'];
$quantidade = $_POST['quantidade'];
$personalizacao = $_POST['personalizacao'];


$sql = "SELECT * FROM produto WHERE idProdt = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar pedido do Topper de bolo</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/finalizaCompra.css">
    <script src="../js/base.js" defer></script>
    <script src="../js/finalizaT.js" defer></script>
</head>
<body>
    <header>
        <button onclick="goBack()">Voltar</button>
        <section id="bloco_nome">
            <h1 id="grafica">Gráfica</h1>
            <h1 id="mundodalua">MUNDO DA LUA</h1>
        </section>
    </header> 
    <article class="main">   
        <article class="box">
            <h3><?= $produto['dscProdt'];?></h3>
            <img src=<?= $produto['urlImagemProdt'];?> alt="Topper de bolo">
            <h4>Quantidade: <?= $quantidade?></h4>
           
            <h3>Descrição</h3>
            <p class="description">
                <?= $produto['dscDetalProdt']?> </p>
        </article>
        <article class="box personaliza">
            <h2>Personalização</h2>
            <textarea name="" id="" placeholder="Ex: Quero que o topper de bolo seja da personagem do filme moana..."><?= $personalizacao?></textarea>
            
            
            <p id="preco">Preço: R$<?= $quantidade*$produto['valProdt']; ?><spam id="textvalor"></spam></p>  
            <a href="opcaopg.php?id=<?= $produto['idProdt'] ?>&quantidade=<?= $quantidade ?>&valor=<?= $personalizacao ?>"><button class="submit-btn" >Finalizar Compra</button></a>     
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
                    <a href="https://www.instagram.com/omundodaluaservicosdigitais?igsh=ZXlzZWdlbGE1ZWhq"><img src="../img/instagram.png" alt=""></a>
                    <a href="https://www.instagram.com/omundodaluaservicosdigitais?igsh=ZXlzZWdlbGE1ZWhq"><p>@omundodalua<br>servicosdigitais</p></a>
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