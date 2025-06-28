<?php
// Inicie a sessão primeiro
session_start();

// Verifique se o usuário está logado
if(!isset($_SESSION['idUsu'])) {
    header("Location: login.php");
    exit;
}

include("../paginas/conexao.php");
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
                <label for="nome">Nome: </label>
                <input type="text" id="nome" name="nome" required>

                <label for="telefone">Telefone </label>
                <input type="number" id="telefone" name="telefone" required>

                <label for="emailUsu">Email:</label>
                <input type="text" id="email" name="email" required>

                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required>

                <label for="nascimento">Nascimento:</label>
                <input type="tel" id="nascimento" name="nascimento" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required />

                <label for="senha">Confirmar Senha:</label>
                <input type="password" id="confirmacao" name="confirmacao" required />

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

    <!-- Navegação -->
    <script src="../js/nav.js" defer></script>

    <!--js para excluir e cadastrar usuários-->
    <script src="../js/admUsuar.js" defer></script>

    
</body>
</html>