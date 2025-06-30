<?php
session_start();
if (!isset($_SESSION['eh_admin'])) {
    header("Location: ../paginas/login.php");
    exit;
}

require("conexao.php");

$mensagem = '';
if (isset($_GET['sucesso'])) {
    switch($_GET['sucesso']) {
        case 1: $mensagem = '<div class="alert alert-success">Produto cadastrado com sucesso!</div>'; break;
        case 2: $mensagem = '<div class="alert alert-success">Produto atualizado com sucesso!</div>'; break;
        case 3: $mensagem = '<div class="alert alert-success">Produto excluído com sucesso!</div>'; break;
    }
} elseif (isset($_GET['erro'])) {
    $mensagem = '<div class="alert alert-danger">Ocorreu um erro. Por favor, tente novamente.</div>';
}

// Processar exclusão
if (isset($_GET['excluir'])) {
    try {
        $conn->beginTransaction();

        // Buscar informações da imagem

        $stmt = $conn->prepare("SELECT urlImagemProdt FROM produto WHERE idProdt = ?");
        $stmt->execute([$_GET['excluir']]);
        $produto = $stmt->fetch();

        // Remover imagem se existir

        if ($produto && !empty($produto['urlImagemProdt'])) {
            $caminhoImagem = "../img/" . $produto['urlImagemProdt'];
            if (file_exists($caminhoImagem) && is_file($caminhoImagem)) {
                unlink($caminhoImagem);
            }
        }

        // Excluir do banco

        $stmt = $conn->prepare("DELETE FROM produto WHERE idProdt = ?");
        $stmt->execute([$_GET['excluir']]);
        
        $conn->commit();
        header("Location: admProd.php?sucesso=3");
        exit;
        
    } catch (PDOException $e) {
        $conn->rollBack();
        error_log("Erro ao excluir: " . $e->getMessage());
        header("Location: admProd.php?erro=2");
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
            
           <section class="form-usu">
                <form id="formProduto" method="POST" action="processaProduto.php" enctype="multipart/form-data">
                    <h2><?= isset($_GET['editar']) ? 'Editar Produto' : 'Cadastrar Novo Produto' ?></h2>
                    <input type="hidden" name="idProdt" value="<?= isset($_GET['editar']) ? $_GET['editar'] : '' ?>">

                    <!-- Linha 1: Nome e Preço -->
                    <div class="form-group">
                        <div>
                            <label for="nomeProd">Nome do Produto:</label>
                            <input type="text" id="nomeProd" name="nomeProd" required>
                        </div>
                        <div>
                            <label for="valProd">Preço (R$):</label>
                            <input type="number" id="valProd" name="valProd" step="0.01" required>
                        </div>
                    </div>

                    <!-- Linha 2: Descrição e Estoque -->
                    <div class="form-group">
                        <div>
                            <label for="descricaoProd">Descrição:</label>
                            <input type="text" id="descricaoProd" name="descricaoProd" required>
                        </div>
                        <div>
                            <label for="estoqueProd">Estoque:</label>
                            <input type="number" id="estoqueProd" name="estoqueProd" min="0" value="1" required>
                        </div>
                    </div>

                    <!-- Linha 3: Estoque Mínimo e Desconto -->
                    <div class="form-group">
                        <div>
                            <label for="qtdMinEstqProd">Estoque Mínimo:</label>
                            <input type="number" id="qtdMinEstqProd" name="qtdMinEstqProd" min="0" required>
                        </div>
                        <div>
                            <label for="pctDescProd">Desconto (%):</label>
                            <input type="number" id="pctDescProd" name="pctDescProd" step="0.01">
                        </div>
                    </div>

                    <!-- Linha 4: Categoria e Imagem -->
                    <div class="form-group">
                        <div>
                            <label for="categoriaProd">Categoria:</label>
                            <select id="categoriaProd" name="idCatProd" required>
                                <option value="">Selecione...</option>
                                <option value="Fotos">Fotos</option>
                                <option value="Papelaria">Papelaria</option>
                                <option value="Personalizados">Personalizados</option>
                            </select>
                        </div>
                        <div>
                            <label for="urlImagemProdt">Imagem:</label>
                            <input type="file" id="urlImagemProdt" name="urlImagemProdt" accept="image/*">
                        </div>
                    </div>

                    <!-- Botões (MESMO ESTILO DO USUÁRIO) -->
                    <div class="btn-group">
                        <button type="submit" class="btnCad"><?= isset($_GET['editar']) ? 'Atualizar' : 'Cadastrar' ?></button>
                        <a href="admProd.php" class="btnExc">Cancelar</a>
                    </div>
                </form>
            </section>

            <section id="prod-lista">
                <h3>Produtos Cadastrados</h3>

                <!-- Barra de busca -->

                <div class="mb-3">
                    <input type="text" id="buscaProduto" class="form-control" placeholder="Buscar produto...">
                    <div id="resultadoBusca" class="mt-2"></div>
                </div>
                    
                <?php include("../paginas/listarProd.php");?>
            </section> 
            
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!--js para adicionar os produtos-->
    <script src="../js/admProd.js" defer></script>

    <script src="../js/produtos.js" defer></script>

</body>
</html>