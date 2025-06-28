<?php
session_start();
if (!isset($_SESSION['eh_admin'])) {
    header("Location: ../paginas/login.php");
    exit;
}

include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação dos dados
    $nome = filter_input(INPUT_POST, "nomeProd", FILTER_SANITIZE_STRING);
    $preco = filter_input(INPUT_POST, "valProd", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $descricao = filter_input(INPUT_POST, "descricaoProd", FILTER_SANITIZE_STRING);
    $estoque = filter_input(INPUT_POST, "estoqueProd", FILTER_SANITIZE_NUMBER_INT);
    $categoria = filter_input(INPUT_POST, "idcatProd", FILTER_SANITIZE_NUMBER_INT);
    $marca = filter_input(INPUT_POST, "idMarca", FILTER_SANITIZE_NUMBER_INT);
    $minEstoque = filter_input(INPUT_POST, "qtdMinEstqProd", FILTER_SANITIZE_NUMBER_INT);
    $desconto = filter_input(INPUT_POST, "pctDescProd", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $dataCadastro = date('Y-m-d H:i:s');

    // Tratamento da imagem
    $urlImagem = "";
    if (isset($_FILES["imagemProd"])) {
        $diretorio = "../img/produtos/";
        
        // Verifica se o diretório existe, se não, cria
        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        $nomeImagem = md5(uniqid()) . '_' . basename($_FILES["imagemProd"]["name"]);
        $destino = $diretorio . $nomeImagem;
        
        // Verifica se é uma imagem válida
        $check = getimagesize($_FILES["imagemProd"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["imagemProd"]["tmp_name"], $destino)) {
                $urlImagem = "produtos/" . $nomeImagem;
            }
        }
    }

    try {
        $sql = "INSERT INTO produto (
                dscProdt, 
                dscDetalProdt, 
                qtdAtualEstqProdt, 
                urlImagemProdt, 
                datCadastProdt, 
                qtdMinEstqProdt, 
                pctDescProdt, 
                valProdt, 
                idCatProd, 
                idMarca
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
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

        if ($stmt->execute()) {
            header("Location: admProd.php?sucesso=1");
            exit;
        } else {
            header("Location: admProd.php?erro=1");
            exit;
        }
    } catch (Exception $e) {
        header("Location: admProd.php?erro=1");
        exit;
    } finally {
        if (isset($stmt)) $stmt->close();
        $conn->close();
    }
} else {
    header("Location: admProd.php");
    exit;
}
?>