<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar pedido do Topper de bolo</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/finalizaTopper.css">
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
            <h2>Topper de bolo</h2>
            <img src="/img/topper.png" alt="Topper de bolo">
            <h4>R$15,00 - R$25,00</h4>
            <h3>Descrição</h3>
            <p class="description">
                Topper de bolo : 15,00 sem a montagem e 25,00 com a montagem. Um lindo e criativo topo de bolo, personalizável do jeito que você quiser para decorar seu bolo e trazer lembranças bonitas para um momento especial.           </p>
        </article>
        <article class="box personaliza">
            <h2>Personalização</h2>
            <textarea name="" id="" placeholder="Ex: Quero que o topper de bolo seja da personagem do filme moana..."></textarea>
            <section class="escolha-montag">
                <label><input type="radio" name="escolha" value="15"> Sem montagem</label> 
            </section>
            <section class="escolha-montag">
                <label><input type="radio" name="escolha" value="25"> Com montagem</label>
            </section>
            <section class="quanti">
                <label>Quantidade:</label>
                <input type="number" id="meuInput" min="1" value="1">
                <button class="preco-btn">preço</button>
            </section>
            <p id="preco">Preço: <spam id="textvalor"></spam></p>  
            <button class="submit-btn" onclick="goTelaPg()">Finalizar Compra</button>     
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
                    <img src="/img/instagram.png" alt="">
                    <p>@omundodaluaservicosdigitais</p>
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