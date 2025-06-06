<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar pedido do marcador de pagina</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/finalizaTopper.css">
    <link rel="stylesheet" href="/css/finalizaMarcaPg.css">
    <script src="/js/base.js" defer></script>
    <script src="/js/finalizaT.js" defer></script>
    
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
            <h2>Marcador de página</h2>
            <img src="/img/marcaPg.png" alt="marca pagina">
            <h4>R$1,50 - R$3,00</h4>
            <h3>Descrição</h3>
            <p class="description">
                Marca páginas magnéticos: marca páginas personalizados do seu jeito para marcar suas páginas sem amassar ou rasgar páginas, ou deixar marcas ou com risco de cair do livro por causa dos ímas nas pontas.</p>
            <p id="espaco"></p>
        </article>
        <article class="box personaliza">
            <h2>Personalização</h2>
            <textarea name="" id="" placeholder="Ex: Quero que o marca pagina seja da personagem do filme moana..."></textarea>
            <h3>Quantidade por pacote:</h3>
            <section class="escolha-montag">
                <label><input type="radio" name="escolha" value="1.5"> Com 1 marcador</label> 
            </section>
            <section class="escolha-montag">
                <label><input type="radio" name="escolha" value="3"> Com 2 marcadores</label>
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
                <a href="/paginas/login.html">Login</a><br>
                <a href="/paginas/cadastro.html">Cadastra-se</a><br>
                <a href="/paginas/telaPedidos.html">Meus pedidos</a>
            </section>
            <section>
                <h3>Sobre Nós</h3>
                <a href="/paginas/sobreaEmpresa.html">Sobre a Empresa</a>
            </section>
        </section>
    </footer>  
</body>
</html>