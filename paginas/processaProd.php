<?php
session_start();
if (!isset($_SESSION['eh_admin'])) {
    header("Location: ../paginas/login.php");
    exit;
}

require("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn->beginTransaction();
        
        $dados = [
            'nome' => $_POST['nomeProd'],
            'preco' => str_replace(',', '.', $_POST['valProd']),
            'descricao' => $_POST['descricaoProd'],
            'estoque' => $_POST['estoqueProd'],
            'categoria' => $_POST['idcatProd'],
            'marca' => $_POST['idMarca'],
            'minEstoque' => $_POST['qtdMinEstqProd'],
            'desconto' => isset($_POST['pctDescProd']) ? str_replace(',', '.', $_POST['pctDescProd']) : 0,
            'dataCadastro' => date('Y-m-d H:i:s')
        ];
        
        // Processamento da imagem
        if (isset($_FILES['imagemProd']) && $_FILES['imagemProd']['error'] == UPLOAD_ERR_OK) {
            $diretorio = "../img/produtos/";
            if (!file_exists($diretorio)) mkdir($diretorio, 0755, true);
            
            $ext = pathinfo($_FILES['imagemProd']['name'], PATHINFO_EXTENSION);
            $nomeImagem = md5(uniqid()) . '.' . $ext;
            $destino = $diretorio . $nomeImagem;
            
            if (move_uploaded_file($_FILES['imagemProd']['tmp_name'], $destino)) {
                $dados['imagem'] = "produtos/" . $nomeImagem;
            }
        }
        
        // Se for edição
        if (!empty($_POST['idProdt'])) {
            $dados['id'] = $_POST['idProdt'];
            
            // Se há nova imagem, remove a antiga
            if (!empty($dados['imagem'])) {
                $stmt = $conn->prepare("SELECT urlImagemProdt FROM produto WHERE idProdt = ?");
                $stmt->execute([$dados['id']]);
                $imagemAntiga = $stmt->fetchColumn();
                
                if ($imagemAntiga && file_exists("../img/" . $imagemAntiga)) {
                    unlink("../img/" . $imagemAntiga);
                }
            }
            
            $sql = "UPDATE produto SET
                    dscProdt = :nome,
                    dscDetalProdt = :descricao,
                    qtdAtualEstqProdt = :estoque,
                    urlImagemProdt = :imagem,
                    qtdMinEstqProdt = :minEstoque,
                    pctDescProdt = :desconto,
                    valProdt = :preco,
                    idCatProd = :categoria,
                    idMarca = :marca
                    WHERE idProdt = :id";
        } else {
            $sql = "INSERT INTO produto (
                    dscProdt, dscDetalProdt, qtdAtualEstqProdt, urlImagemProdt,
                    datCadastProdt, qtdMinEstqProdt, pctDescProdt, valProdt,
                    idCatProd, idMarca
                ) VALUES (
                    :nome, :descricao, :estoque, :imagem,
                    :dataCadastro, :minEstoque, :desconto, :preco,
                    :categoria, :marca
                )";
        }
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($dados);
        
        $conn->commit();
        header("Location: admProd.php?sucesso=" . (!empty($_POST['idProdt']) ? "2" : "1"));
        exit;
        
    } catch (PDOException $e) {
        $conn->rollBack();
        error_log("Erro: " . $e->getMessage());
        header("Location: admProd.php?erro=1");
        exit;
    }
}

header("Location: admProd.php");
?>