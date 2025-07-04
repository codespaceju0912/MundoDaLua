<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sobreaEmpresa.css">
    <script src="../js/base.js" defer></script>
</head>

<body>
    <header>
        <section id="bloco_nome" onclick="goSobre()">
            <h1 id="grafica">Gráfica</h1>
            <h1 id="mundodalua">MUNDO DA LUA</h1>
        </section>
        <section id="bloco_pesquisa">
            <input  id="barradepesquisa" class="montserrat" type="text" placeholder="Encontre aqui o melhor produto para você">
            <button id="botaoPesquisar"><img src="../img/lupaBranca.png" alt="" id="imagemLupa"></button>
        </section>
        <section class="usuario">
            <img src="../img/usuario.png">
            <p>Faça o <a href="../paginas/login.php">LOGIN</a> ou <a href="/paginas/cadastro.php">CADASTRE-SE</a></p>
        </section>
        <section class="carrinho" onclick="goCarrinho()">
            <a href="../paginas/telaCarrinho.php"><img src="../img/carrinho.png"></a>
            <p><a href="../paginas/telaCarrinho.php">Carrinho</a></p>
        </section>
    </header> 
    <nav>
        <section id="corCategoria">
            <p>Categorias</p>
            <img src="../img/setaMenu.png" alt="">
        </section>
        <section class="palavrasNav" onclick="goTela()">
            <p>Produtos</p>
        </section>
        <section class="palavrasNav"onclick="goPedidos()">
            <p>Acompanhar Pedidos</p>
        </section>
    </nav>
    <section class="quem-somos">
        <h2>Quem Somos</h2>
        <p>
            Somos o Mundo da Lua, uma loja de serviços digitais e criações personalizadas, 
            feita com carinho por Michelle e Lannay. Aqui, ideias malucas viram 
            produtos únicos — cheios de criatividade, amor e propósito. 💛
        </p>

        <h3>Sobre nós</h3>
        <p>🌙 Sobre Nós
        O Mundo da Lua nasceu de um momento delicado, mas cheio de coragem, esperança e amor. Surgiu em abril de 2024, quando Lannay, que sempre sonhou alto e amava o universo, enfrentava dificuldades para conciliar os estudos com o mercado de trabalho. Percebendo isso, uma vizinha querida, ofereceu seu espaço durante o dia para que ela pudesse começar algo próprio: um pequeno serviço de impressões.
        Com o apoio de Michelle, sua mãe, a ideia ganhou forma, força e coração. Começamos com o que tínhamos: uma impressora emprestada, vontade de trabalhar e o desejo de fazer a diferença na vida das pessoas ao nosso redor. A paixão por criar e o cuidado com cada cliente nos levaram a transformar um cantinho da casa em uma loja de verdade. No dia 27 de maio de 2024, o Mundo da Lua ganhou seu espaço oficial — simples, mas cheio de significado.
        O nome Mundo da Lua é uma homenagem à Lannay (que significa "pequena lua") e também à nossa essência: um lugar onde ideias criativas, sonhos malucos e pedidos fora do comum são bem-vindos e transformados em realidade com carinho.
        Hoje, oferecemos mais do que serviços digitais. Criamos presentes com propósito, cadernos com identidade, memórias impressas e produtos que conectam pessoas. Cada pedido é único, feito com amor e pensado com dedicação.
        Seja bem-vindo ao nosso mundo. Aqui, acreditamos que sonhar não é bobagem — é o primeiro passo para criar algo incrível. ✨

        <h3>Visão</h3>
        <p>Tornar-se a principal opção em serviços gráficos expressos, unindo velocidade, qualidade e preço justo.</p>

        <h3>Valores</h3>
        <ul>
            <li>Ética</li>
            <li>Amor pelo o que fazemos</li>
            <li>Comprometimento</li>
            <li>Colaboração</li>
            <li>Respeito</li>
        </ul>
    </section>

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