<?php
session_start();
if (!isset($_SESSION['eh_admin'])) {
    header("Location: ../paginas/login.php");
    exit;
}

include("../conexao.php");

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    header("Location: admProd.php");
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Busca o produto no banco de dados
$sql = "SELECT * FROM produto WHERE idProdt = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produto = $result->fetch_assoc();

if (!$produto) {
    header("Location: admProd.php?erro=3");
    exit;
}

// Processamento do formulário de edição
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = filter_input(INPUT_POST, "nomeProd", FILTER_SANITIZE_STRING);
    $preco = filter_input(INPUT_POST, "valProd", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $descricao = filter_input(INPUT_POST, "descricaoProd", FILTER_SANITIZE_STRING);
    $estoque = filter_input(INPUT_POST, "estoqueProd", FILTER_SANITIZE_NUMBER_INT);
    $categoria = filter_input(INPUT_POST, "idcatProd", FILTER_SANITIZE_NUMBER_INT);
    $marca = filter_input(INPUT_POST, "idMarca", FILTER_SANITIZE_NUMBER_INT);
    $minEstoque = filter_input(INPUT_POST, "qtdMinEstqProd", FILTER_SANITIZE_NUMBER_INT);
    $desconto = filter_input(INPUT_POST, "pctDescProd", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Tratamento da imagem
    $urlImagem = $produto['urlImagemProdt'];
    if (isset($_FILES["imagemProd"]) && $_FILES["imagemProd"]["error"] == 0) {
        $diretorio = "../img/produtos/";
        $nomeImagem = md5(uniqid()) . '_' . basename($_FILES["imagemProd"]["name"]);
        $destino = $diretorio . $nomeImagem;
        
        // Verifica se é uma imagem válida
        $check = getimagesize($_FILES["imagemProd"]["tmp_name"]);
        if ($check !== false) {
            // Remove a imagem antiga se existir
            if (!empty($produto['urlImagemProdt'])) {
                $caminhoAntigo = "../img/" . $produto['urlImagemProdt'];
                if (file_exists($caminhoAntigo)) {
                    unlink($caminhoAntigo);
                }
            }
            
            if (move_uploaded_file($_FILES["imagemProd"]["tmp_name"], $destino)) {
                $urlImagem = "produtos/" . $nomeImagem;
            }
        }
    }

    try {
        $sql = "UPDATE produto SET
                dscProdt = ?,
                dscDetalProdt = ?,
                qtdAtualEstqProdt = ?,
                urlImagemProdt = ?,
                qtdMinEstqProdt = ?,
                pctDescProdt = ?,
                valProdt = ?,
                idCatProd = ?,
                idMarca = ?
                WHERE idProdt = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssisssddii",
            $nome,
            $descricao,
            $estoque,
            $urlImagem,
            $minEstoque,
            $desconto,
            $preco,
            $categoria,
            $marca,
            $id
        );

        if ($stmt->execute()) {
            header("Location: admProd.php?sucesso=3");
            exit;
        } else {
            header("Location: editarProduto.php?id=$id&erro=1");
            exit;
        }
    } catch (Exception $e) {
        header("Location: editarProduto.php?id=$id&erro=1");
        exit;
    }
}

// Se não for POST, exibe o formulário de edição
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../css/admProd.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('header.php'); ?>

    <main>
        <div id="container">
            <h1>Editar Produto</h1>
            
            <form id="formProduto" method="POST" action="editarProduto.php?id=<?= $id ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nomeProd" class="form-label">Nome do Produto:</label>
                    <input type="text" class="form-control" id="nomeProd" name="nomeProd" value="<?= htmlspecialchars($produto['dscProdt']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="valProd" class="form-label">Preço (R$):</label>
                    <input type="number" class="form-control" id="valProd" name="valProd" step="0.01" value="<?= htmlspecialchars($produto['valProdt']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="descricaoProd" class="form-label">Descrição:</label>
                    <textarea class="form-control" id="descricaoProd" name="descricaoProd" rows="3" required><?= htmlspecialchars($produto['dscDetalProdt']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="estoqueProd" class="form-label">Quantidade em Estoque:</label>
                    <input type="number" class="form-control" id="estoqueProd" name="estoqueProd" min="0" value="<?= htmlspecialchars($produto['qtdAtualEstqProdt']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="qtdMinEstqProd" class="form-label">Estoque Mínimo:</label>
                    <input type="number" class="form-control" id="qtdMinEstqProd" name="qtdMinEstqProd" min="0" value="<?= htmlspecialchars($produto['qtdMinEstqProdt']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="pctDescProd" class="form-label">Desconto (%):</label>
                    <input type="number" class="form-control" step="0.01" id="pctDescProd" name="pctDescProd" value="<?= htmlspecialchars($produto['pctDescProdt']) ?>">
                </div>
                
                <div class="mb-3">
                    <label for="idcatProd" class="form-label">Categoria:</label>
                    <select class="form-select" id="idcatProd" name="idcatProd" required>
                        <option value="">Selecione...</option>
                        <option value="1" <?= $produto['idCatProd'] == 1 ? 'selected' : '' ?>>Fotos</option>
                        <option value="2" <?= $produto['idCatProd'] == 2 ? 'selected' : '' ?>>Papelaria</option>
                        <option value="3" <?= $produto['idCatProd'] == 3 ? 'selected' : '' ?>>Personalizados</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="idMarca" class="form-label">Marca:</label>
                    <input type="number" class="form-control" id="idMarca" name="idMarca" value="<?= htmlspecialchars($produto['idMarca']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="imagemProd" class="form-label">Imagem:</label>
                    <input type="file" class="form-control" id="imagemProd" name="imagemProd" accept="image/*">
                    <?php if (!empty($produto['urlImagemProdt'])): ?>
                        <div class="mt-2">
                            <img src="../img/<?= htmlspecialchars($produto['urlImagemProdt']) ?>" width="100" class="img-thumbnail">
                            <p class="text-muted mt-1">Imagem atual</p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    <a href="admProd.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>