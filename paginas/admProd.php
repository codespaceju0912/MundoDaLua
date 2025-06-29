<?php
session_start();
if (!isset($_SESSION['eh_admin'])) {
    header("Location: ../paginas/login.php");
    exit;
}

include("conexao.php");

$mensagem = '';
if (isset($_GET['sucesso'])) {
    switch($_GET['sucesso']){
        case 1: $mensagem = '<div class="alert alert-success">Produto cadastrado com sucesso!</div>'; break;
        case 2: $mensagem = '<div class="alert alert-success">Produto atualizado com sucesso!</div>'; break;
        case 3: $mensagem = '<div class="alert alert-success">Produto excluído com sucesso!</div>'; break;
    }
} elseif (isset($_GET['erro'])) {
    $mensagem = '<div class="alert alert-danger">Ocorreu um erro. Por favor, tente novamente.</div>';
}

//Processar exclusão de produto
if (isset($_GET['excluir'])) {
    $id = filter_input(INPUT_GET, 'excluir', FILTER_SANITIZE_NUMBER_INT);

    //Primeiro obtém a imagem para remover do servidor
    $sql = "SELECT urlImagemProdt FROM produto WHERE idProdt = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $produto = $result->fetch_assoc();

    if($produto && !empty($produto['urlImagemProdt'])){
        $caminhoImagem = "../img/" . $produto['urlImagemProdt'];
        if(file_exists($caminhoImagem)) {
            unlink($caminhoImagem);
        }
    }

    //Exclui o produto
    $sql = "DELETE FROM produto WHERE idProdt = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admProd.php?sucesso=3");
        exit;
    } else {
        header("Location: admProd.php?erro=1");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produto</title>
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

            <?php echo $mensagem; ?>
            
            <section>
                <form id="formProduto" method="POST" action="processaProduto.php" enctype="multipart/form-data">
                    <h2><?= isset($_GET['editar']) ? 'Editar Produto' : 'Cadastrar Novo Produto' ?></h2>
                    <input tupe="hidden" name="idProdt" value="<?= isset($_GET['editar']) ? $_GET['editar'] : '' ?>">    

                            
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

                    <label for="urlImagemProdt">Imagem:</label>
                    <input type="file"  id="urlImagemProdt" name="urlImagemProdt" accept="image/*">
                            
                    <div class="btn-group">
                        <button type="submit" class="btnCad"><?= isset ($_GET['editar']) ? 'Autaulizar' : 'Cadastrar' ?></button>
                        <a href="admProd.php" class="btnCan">Cancelar</a>
                    </div>
                </form>

                <section id="prod-lista">
                    <h3>Produtos Cadastrados</h3>

                    <!-- Barra de busca -->

                    <div class="mb-3">
                        <input type="text" id="buscaProduto" class="form-control" placeholder="Buscar produto...">
                        <div id="resultadoBusca" class="mt-2"></div>
                    </div>
                    
                    <?php include("../paginas/listarProd.php");?>
                </section> 
            </section> 
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!--js para adicionar os produtos-->
    <script src="../js/admProd.js" defer></script>

    <script src="../js/produtos.js" defer></script>

</body>
</html>