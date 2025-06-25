<?php

session_start();

if (!isset($_SESSION['tipoUsu']) || $_SESSION['tipoUsu'] !== 'admin') {
    header("Location: /paginas/index.html");
    exit;
}

?>