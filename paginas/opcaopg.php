<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar pedido do Topper de bolo</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/opcaopg.css">
    <script src="/js/base.js"></script>
    <script src="/js/opcaoPg.js"></script>
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
            <section class="payment-methods">
                <label><input type="radio" name="payment" value="pix"> Pagar pelo pix</label> 
            </section>
            <section class="payment-methods">
                <label><input type="radio" name="payment" value="local"> Pagar no local</label> 
            </section> 
            <p>R. Tuffi Salomão Borges, 91 - José de Anchieta II, Serra - ES, 29162-502</p>
            <button class="submit-btn">Realizar pagamento</button>     
        </article>
        
    </article>
    <footer>
        <section class="justify-content-around">
            <img src="/img/logoWhat.png" id="logoW">
            <p>27 99201-0821</p>
        </section>
        <section class="justify-content-around">
            <img src="/img/logoInst.png" id="logoI">
            <p>@omundodaluaservicosdigitais</p>
        </section>
        <section class="justify-content-around">
            <img src="/img/logoLocaliza.png" id="logoL">
            <p>R. Tuffi Salomão Borges, 91 - José de Anchieta II, Serra - ES, 29162-502</p>
        </section>
    </footer>  
</body>
</html>