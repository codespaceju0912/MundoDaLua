<?php

session_start();


//Verifica se está logado
if(!isset($_SESSION['idUsu']) || !isset($_SESSION['tipoUsu'])) {
    header("Location: /paginas/login.php");
    exit();
}


// Verifica se é administrador
if($_SESSION['tipoUsu'] !== 'admin') {
    echo "<h2>Acesso negado. Esta área é restrita a administradores.</h2>";
    exit();
}
?>