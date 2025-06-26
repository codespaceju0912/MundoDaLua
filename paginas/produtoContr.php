<?php
include("../paginas/loginBD.php");

$acao = $_POST['acao'];

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
    $nomeImagem = basename($_FILES["imagemProd"]["name"]);
    $destino = "../img/" . $nomeImagem;
    if (move_uploaded_file($_FILES["imagemProd"]["tmp_name"], $destino)) {
        $urlImagem = $nomeImagem;
    }
}

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
    echo "Produto cadastrado com sucesso!";

} elseif ($acao === "alterar" && $id) {
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
    } else {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssiiddiii",
            $nome, $descricao, $estoque, $minEstoque,
            $desconto, $preco, $categoria, $marca, $id
        );
    }

    $stmt->execute();
    echo "Produto alterado com sucesso!";

} elseif ($acao === "excluir" && $id) {
    $stmt = $conn->prepare("DELETE FROM produto WHERE idProdt = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "Produto excluído com sucesso!";
}

$conn->close();
?>