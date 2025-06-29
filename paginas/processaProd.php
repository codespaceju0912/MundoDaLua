<?php
session_start();
if (!isset($_SESSION['eh_admin'])) {
    header("Location: ../paginas/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitização dos dados
    $id = filter_input(INPUT_POST, 'idProdt', FILTER_SANITIZE_NUMBER_INT);
    $nome = $conn->real_escape_string($_POST['nomeProd']);
    $preco = (float) str_replace(',', '.', $_POST['valProd']);
    $descricao = $conn->real_escape_string($_POST['descricaoProd']);
    $estoque = (int) $_POST['estoqueProd'];
    $categoria = (int) $_POST['idcatProd'];
    $marca = (int) $_POST['idMarca'];
    $minEstoque = (int) $_POST['qtdMinEstqProd'];
    $desconto = isset($_POST['pctDescProd']) ? (float) str_replace(',', '.', $_POST['pctDescProd']) : 0;
    $dataCadastro = date('Y-m-d H:i:s');

    // Processamento da imagem
    $urlImagem = '';
    if (!empty($id)) {
        // Se for edição, mantém a imagem atual
        $sql = "SELECT urlImagemProdt FROM produto WHERE idProdt = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $produto = $result->fetch_assoc();
        $urlImagem = $produto['urlImagemProdt'];
    }

    if (isset($_FILES['imagemProd']) && $_FILES['imagemProd']['error'] == UPLOAD_ERR_OK) {
        $diretorio = "../img/produtos/";
        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0755, true);
        }

        $extensao = pathinfo($_FILES['imagemProd']['name'], PATHINFO_EXTENSION);
        $nomeImagem = md5(uniqid()) . '.' . $extensao;
        $destino = $diretorio . $nomeImagem;

        // Verifica se é uma imagem válida
        if (getimagesize($_FILES['imagemProd']['tmp_name']) !== false) {
            // Remove a imagem antiga se existir
            if (!empty($urlImagem)) {
                $caminhoAntigo = "../img/" . $urlImagem;
                if (file_exists($caminhoAntigo)) {
                    unlink($caminhoAntigo);
                }
            }

            if (move_uploaded_file($_FILES['imagemProd']['tmp_name'], $destino)) {
                $urlImagem = "produtos/" . $nomeImagem;
            }
        }
    }

    // Determina se é inserção ou atualização
    if (empty($id)) {
        $sql = "INSERT INTO produto (
                dscProdt, dscDetalProdt, qtdAtualEstqProdt, urlImagemProdt, 
                datCadastProdt, qtdMinEstqProdt, pctDescProdt, valProdt, idCatProd, idMarca
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $tipos = "ssisssddii";
    } else {
        $sql = "UPDATE produto SET
                dscProdt = ?, dscDetalProdt = ?, qtdAtualEstqProdt = ?, urlImagemProdt = ?,
                qtdMinEstqProdt = ?, pctDescProdt = ?, valProdt = ?, idCatProd = ?, idMarca = ?
                WHERE idProdt = ?";
        $tipos = "ssisssddii";
    }

    $stmt = $conn->prepare($sql);
    if (empty($id)) {
        $stmt->bind_param($tipos, $nome, $descricao, $estoque, $urlImagem, 
                         $dataCadastro, $minEstoque, $desconto, $preco, $categoria, $marca);
    } else {
        $stmt->bind_param($tipos, $nome, $descricao, $estoque, $urlImagem,
                         $minEstoque, $desconto, $preco, $categoria, $marca, $id);
    }

    if ($stmt->execute()) {
        header("Location: admProd.php?sucesso=" . (empty($id) ? "1" : "2"));
        exit;
    } else {
        header("Location: admProd.php?erro=1");
        exit;
    }
} else {
    header("Location: admProd.php");
    exit;
}
?>