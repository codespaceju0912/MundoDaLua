<?php
include("../paginas/loginBD.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nomeProd"];
    $preco = $_POST["valProd"];
    $descricao = $_POST["descricaoProd"];
    $estoque = $_POST["estoqueProd"];
    $categoria = $_POST["idcatProd"];
    $marca = $_POST["idMarca"];
    $minEstoque = $_POST["qtdMinEstqProd"];
    $desconto = $_POST["pctDescProd"];
    $dataCadastro = date('Y-m-d H:i:s');


    $urlImagem = "";
    if (isset($_FILES["imagemProd"]) && $_FILES["imagemProd"]["error"] == 0) {
        $nomeImagem = basename($_FILES["imagemProd"]["name"]);
        $destino = "../img/" . $nomeImagem;
        if (move_uploaded_file($_FILES["imagemProd"]["tmp_name"], $destino)) {
            $urlImagem = $nomeImagem;
        }
    }

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
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>