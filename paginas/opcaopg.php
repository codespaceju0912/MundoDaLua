<?php
session_start();
$nome = $_SESSION['nomeUsu'];
$id = $_SESSION['idUsu'];

if(empty($nome) || empty($id) ) {
    echo "<script>alert('Paa comprar você precisa estar logado!'); window.location.href = '../paginas/login.php';</script>";
    exit;
}
$idProduto = $_POST['idProduto'];
$quantidade = $_POST['quantidade'];
$valor = $POST['valor'];
$personalizacao = $_POST['personalizacao']
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar pedido do Topper de bolo</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/opcaopg.css">
    <script src="../js/base.js"></script>
    <script src="../js/opcaoPg.js"></script>
</head>
<body>
    <header>
        <button onclick="goBack()">Voltar</button>
        <section id="bloco_nome">
            <h1 id="grafica">Gráfica</h1>
            <h1 id="mundodalua">MUNDO DA LUA</h1>
        </section>
    </header> 
    <article class="container">   
        <article class="box personaliza">
            <h3>Pagamento:</h3>
            <form action="geraPedido.php" method="post">
                <input type="hidden" name="idProduto" value="<?=$idProduto ?>">
                <input type="hidden" name="quantidade" value="<?=$quantidade ?>">
                <input type="hidden" name="valor" value="<?=$valor ?>">
                <input type="hidden" name="personalizacao" value="<?= $personalizacao ?>">

            
                <select name="forma_pagamento">
                    <option value="1">PIX</option>
                    <option value="2">Pagar no local</option>
                    </select>

                
               
                <p>R. Tuffi Salomão Borges, 91 - José de Anchieta II, Serra - ES, 29162-502</p>
                <button class="submit-btn" type="submit">Realizar pagamento</button>  
            </form>   
        </article>
        
    </article>
    <footer>
        <section class="justify-content-around">
            <img src="../img/logoWhat.png" id="logoW">
            <p>27 99201-0821</p>
        </section>
        <section class="justify-content-around">
            <a href="https://www.instagram.com/omundodaluaservicosdigitais?igsh=ZXlzZWdlbGE1ZWhq"><img src="../img/logoInstagramPreta.png" id="logoI"></a>
            <a href="https://www.instagram.com/omundodaluaservicosdigitais?igsh=ZXlzZWdlbGE1ZWhq"><p>@omundodalua<br>servicosdigitais</p></a>
        </section>
        <section class="justify-content-around">
            <img src="../img/logoLocaliza.png" id="logoL">
            <p>R. Tuffi Salomão Borges, 91 - José de Anchieta II, Serra - ES, 29162-502</p>
        </section>
    </footer>  
</body>
</html>