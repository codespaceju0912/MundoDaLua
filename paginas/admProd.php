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
    <title>Cadastrar/Alterar/Excluir Produto</title>
    <link rel="stylesheet" href="../css/admProd.css">
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
        <div id="container">
            <h1>Painel de Produtos</h1>
            
            <section>
                <form id="formProduto" method="POST" action="cadastrarProduto.php" enctype="multipart/form-data">
                    <h2>Cadastrar Novo Produto</h2>
                            
                    <label for="nomeProd">Nome do Produto:</label>
                    <input type="text" id="nomeProd" name="nomeProd" required>
                            
                    <label for="valProd">Preço (R$):</label>
                    <input type="number" id="valProd" name="valProd" step="0.01" required>
                            
                    <label for="descricaoProd">Descrição:</label>
                    <input type="text" id="descricaoProd" name="descricaoProd" required>

                    <label for="estoqueProd">Quantidade em Estoque:</label>
                    <input type="number" id="estoqueProd" name="estoqueProd" min="0" value="1" required>

                    <label for="qtdMinEstqProd">Estoque Mínimo:</label>
                    <input type="number" id="qtdMinEstqProd" name="qtdMinEstqProd" min="0" required>
                            
                    <label for="pctDescProd">Desconto (%):</label>
                    <input type="number" step="0.01" id="pctDescProd" name="pctDescProd">
                    
                    <label for="idCatProd">Categoria (ID):</label>
                    <select id="categoriaProd" required>
                        <option value="">Selecione...</option>
                        <option value="Fotos">Fotos</option>
                        <option value="Papelaria">Papelaria</option>
                        <option value="Personalizados">Personalizados</option>
                    </select> 
                            
                    <div class="btn-group">
                        <button class="btnCad">Cadastrar</button>
                        <button class="btnAlt">Alterar</button>
                        <button class="btnExc">Excluir</button>
                    </div>
                </form>

                <section id="prod-lista">
                    <h3>Produtos Cadastrados</h3>
                    <?php include("../paginas/listarProd.php");?>
                </section> 
            </section> 
        </div>
    </main>

    <!--js para adicionar os produtos-->
    <script src="../js/admProd.js" defer></script>

    <script src="../js/produtos.js" defer></script>

</body>
</html>