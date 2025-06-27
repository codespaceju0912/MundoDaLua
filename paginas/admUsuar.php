<?php include("../paginas/conexao.php"); 
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="../css/admUsuar.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="../js/base.js" defer></script>
</head>
<body>
<header>
        <section id="bloco_mundoDaLua">
            <h1 id="grafica">Gráfica</h1>
            <h1 id="mundodalua">MUNDO DA LUA</h1>
        </section>
    </header>

    <nav>
        <div class="admin-nav">
            <ul>
                <li><a href="/MundoDaLua/paginas/admVisaoGeral.php">Início</a></li>
                <li><a href="/MundoDaLua/paginas/admProd.php">Produtos</a></li>
                <li><a href="/MundoDaLua/paginas/admUsuar.php">Usuários</a></li>
                <li><a href="/MundoDaLua/paginas/admPedid.php">Pedidos</a></li>
                <li><a href="/MundoDaLua/paginas/logout.php" >Sair</a></li>
            </ul>
        </div>
        
    </nav>

    <main>
        <section class="form-usu">
            <h2>Cadastrar Usuário</h2>
            <form id="form-cadUsu">
                <label for="nomeUsu">Nome do Usuário: </label>
                <input type="text" id="nomeUsu" name="nomeUsu" required>

                <label for="emailUsu">Email do Usuário:</label>
                <input type="email" id="emailUsu" name="emailUsu" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required />

                <button class="cad">Cadastrar</button>

            </form>
        </section>

        <section class="list-Usu">
            <h2>Usuários Cadastrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="tabelaUsu">
                    <!--Os usuários vão aparecer aqui-->
                </tbody>
            </table>
        </section>
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
                <a href="https://www.instagram.com/omundodaluaservicosdigitais?igsh=ZXlzZWdlbGE1ZWhq"><img src="/img/instagram.png" alt=""></a>
                <a href="https://www.instagram.com/omundodaluaservicosdigitais?igsh=ZXlzZWdlbGE1ZWhq"><p>@omundodalua<br>servicosdigitais</p></a>
            </section>
        </div>
        <div>
            <h3>Área do Cliente</h3>
            <a href="../paginas/login.php">Login</a><br>
            <a href="../paginas/cadastro.php">Cadastre-se</a><br>
            <a href="../paginas/telaPedidos.php">Meus pedidos</a>
        </div>
        <div>
            <h3>Sobre Nós</h3>
            <a href="../paginas/sobreaEmpresa.php">Sobre a Empresa</a>
        </div>
    </footer>

    <!-- Navegação -->
    <script src="../js/nav.js" defer></script>

    <!--js para excluir e cadastrar usuários-->
    <script src="../js/admUsuar.js" defer></script>

    
</body>
</html>