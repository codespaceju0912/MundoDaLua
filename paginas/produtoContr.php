<?php
include("../paginas/loginBD.php");

// Verifica se é admin
if(!isset($_SESSION['admin_logado'])) {
    echo json_encode(['status' => 'error', 'message' => 'Acesso não autorizado!']);
    exit;
}

$acao = $_POST['acao'] ?? '';
$id = $_POST['idProdt'] ?? null;

// Dados do formulário
$id = $_POST['idProdt'] ?? null;
$nome = $_POST['nomeProd'];
$preco = $_POST['valProd'];
$descricao = $_POST['descricaoProd'];
$estoque = $_POST['estoqueProd'];
$minEstoque = $_POST['qtdMinEstqProd'];
$desconto = $_POST['pctDescProd'];
$categoria = $_POST['idCatProd'];
$marca = $_POST['idMarca'];
$dataCadastro = date("Y-m-d H:i:s");

// imagem
$urlImagem = "";
if (isset($_FILES["imagemProd"]) && $_FILES["imagemProd"]["error"] == 0) {
    $extensao = pathinfo($_FILES["imagemProd"]["name"], PATHINFO_EXTENSION);
    $nomeImagem = uniqid() . '.' . $extensao;
    $destino = "../img/" . $nomeImagem;

    if (!file_exists('../img')) {
        mkdir('../img', 0777, true);
    }

    if (move_uploaded_file($_FILES["imagemProd"]["tmp_name"], $destino)) {
        $urlImagem = $nomeImagem;
    }
}

try {
    // CADASTRAR PRODUTO
    if ($acao === "cadastrar") {
        $stmt = $conn->prepare("INSERT INTO produto (
            dscProdt, dscDetalProdt, qtdAtualEstqProdt, urlImagemProdt,
            datCadastProdt, qtdMinEstqProdt, pctDescProdt, valProdt,
            idCatProd, idMarca
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "ssisssddii",
            $nome,
            $descricao,
            $estoque,
            $urlImagem,
            $dataCadastro,
            $minEstoque,
            $desconto,
            $preco,
            $categoria,
            $marca
        );
        $stmt->execute();
        
        echo json_encode(['status' => 'success', 'message' => 'Produto cadastrado com sucesso!']);

    // ALTERAR PRODUTO
    } elseif ($acao === "alterar" && $id) {
        // Primeiro busca a imagem atual para deletar se for substituída
        $imagemAtual = null;
        if ($urlImagem) {
            $stmt = $conn->prepare("SELECT urlImagemProdt FROM produto WHERE idProdt = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $imagemAtual = $result->fetch_assoc()['urlImagemProdt'];
        }

        $sql = "UPDATE produto SET 
            dscProdt = ?, dscDetalProdt = ?, qtdAtualEstqProdt = ?, 
            qtdMinEstqProdt = ?, pctDescProdt = ?, valProdt = ?, 
            idCatProd = ?, idMarca = ?" .
            ($urlImagem ? ", urlImagemProdt = ?" : "") .
            " WHERE idProdt = ?";

        if ($urlImagem) {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                "ssiiddiisi",
                $nome, $descricao, $estoque, $minEstoque,
                $desconto, $preco, $categoria, $marca,
                $urlImagem, $id
            );
            
            // Remove a imagem antiga
            if ($imagemAtual && file_exists("../img/" . $imagemAtual)) {
                unlink("../img/" . $imagemAtual);
            }
        } else {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                "ssiiddiii",
                $nome, $descricao, $estoque, $minEstoque,
                $desconto, $preco, $categoria, $marca, $id
            );
        }

        $stmt->execute();
        echo json_encode(['status' => 'success', 'message' => 'Produto alterado com sucesso!']);

    // EXCLUIR PRODUTO
    } elseif ($acao === "excluir" && $id) {
        // Busca a imagem para remover
        $stmt = $conn->prepare("SELECT urlImagemProdt FROM produto WHERE idProdt = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $imagem = $result->fetch_assoc()['urlImagemProdt'];
        
        // Remove o produto
        $stmt = $conn->prepare("DELETE FROM produto WHERE idProdt = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Remove a imagem
        if ($imagem && file_exists("../img/" . $imagem)) {
            unlink("../img/" . $imagem);
        }
        
        echo json_encode(['status' => 'success', 'message' => 'Produto excluído com sucesso!']);
    }

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erro: ' . $e->getMessage()]);
} finally {
    $conn->close();
}
?>