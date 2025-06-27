<?php
// Inicia a Sessão
session_start();

// Destrói todas as variáveis
session_unset();

// Destrói a sessão
session_destroy();

//Redireciona para a página de login
header("Location: ../index.php");
exit;
?>