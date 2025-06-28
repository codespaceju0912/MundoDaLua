<?php
session_start();
if (!isset($_SESSION['eh_admin'])) {
    header("Location: ../paginas/login.php");
    exit;
}

include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acao'])) {
    $id = filter_input(INPUT_POST, "idProdt", FILTER_SANITIZE_NUMBER_INT);
    
    if ($_POST['acao'] == 'excluir') {
        try {
            // Primeiro obtém o caminho da imagem para excluir do servidor
            $sql = "SELECT urlImagemProdt FROM produto WHERE idProdt = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $produto = $result->fetch_assoc();
            
            if ($produto && !empty($produto['urlImagemProdt'])) {
                $caminhoImagem = "../img/" . $produto['urlImagemProdt'];
                if (file_exists($caminhoImagem)) {
                    unlink($caminhoImagem);
                }
            }
            
            // Agora exclui o produto do banco de dados
            $sql = "DELETE FROM produto WHERE idProdt = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                header("Location: admProd.php?sucesso=2"); // Sucesso ao excluir
                exit;
            } else {
                header("Location: admProd.php?erro=2");
                exit;
            }
        } catch (Exception $e) {
            header("Location: admProd.php?erro=2");
            exit;
        }
    }
} else {
    header("Location: admProd.php");
    exit;
}
?>