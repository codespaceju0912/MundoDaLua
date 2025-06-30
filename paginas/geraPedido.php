<?php


include('conexao.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

$idProduto = $_POST['idProduto'];
$idUsuario = $_SESSION['idUsu'];
$quantidade = $_POST['quantidade'];
$valor = $_POST['valor'];
$personalizacao = $_POST['personalizacao'];
$dataHoraAtual = date('Y-m-d H:i:s'); // Ex: 2025-06-30 14:35:00
$statusPadrao = 'Aguardando pagamento';
$forma_pagamento = $_POST['forma_pagamento'];
$valor = str_replace(',', '.', $_POST['valor']); // garante formato decimal válido
$valor = (float) $valor;

$sql = "INSERT INTO pagamento(valor, dataPagamento, idTpPag, idUsu)
        VALUES(?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([ $valor, $dataHoraAtual, $forma_pagamento, $idUsuario]);

$sql1 = "SELECT * FROM pagamento WHERE valor = ? AND dataPagamento=?AND idTpPag=? AND idUsu = ? ";
$stmt = $conn->prepare($sql1);
$stmt->execute([$valor, $dataHoraAtual, $forma_pagamento, $idUsuario]);
$dados_pagamento = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "INSERT INTO pedido(datPedido, dscStatusPedido, idUsuario, idPagamento, personalizacao, idProdt)
        VALUES(?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$dataHoraAtual, $statusPadrao, $idUsuario, $dados_pagamento['idPagamento'], $personalizacao, $idProduto]);
if($forma_pagamento == 1){
    header('location:pagamentoPIx.php');
} else{
    header('location:pagamentoLocal.php');
}

?>