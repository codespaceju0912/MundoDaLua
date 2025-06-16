<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar pedido de Quadro MDF com foto ou frase</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/finalizaTopper.css">
    <link rel="stylesheet" href="../css/finalizaMdf.css">
    <script src="../js/base.js" defer></script>
    <script src="../js/finalizaM.js" defer></script>
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
            <h2>Quadro MDF com foto ou frase</h2>
            <img src="../img/mdf.jpeg">
            <h4>R$60,00</h4>
            <h3>Descrição</h3>
            <p class="description">
                Quadro MDF com foto ou frase: Opção para guardar e eternizar suas fotos, impressas e molduradas em tamanho A4.           
                <p id="espaco"></p>
        </article>
        <article class="box personaliza">
            <h2>Personalização</h2>
            <textarea name="" id="" placeholder="Ex: Quero que no quadro tenha a imagem..."></textarea>
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
                    <img src="../img/instagram.png" alt="">
                    <p>@omundodaluaservicosdigitais</p>
                </section>
            </section>
            <section>
                <h3>Área do Cliente</h3>
                <a href="../paginas/login.html">Login</a><br>
                <a href="../paginas/cadastro.html">Cadastra-se</a><br>
                <a href="../paginas/telaPedidos.html">Meus pedidos</a>
            </section>
            <section>
                <h3>Sobre Nós</h3>
                <a href="../paginas/sobreaEmpresa.html">Sobre a Empresa</a>
            </section>
        </section>
    </footer>
</body>
</html>