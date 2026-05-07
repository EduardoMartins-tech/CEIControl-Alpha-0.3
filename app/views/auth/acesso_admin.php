<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// INCLUI A CONEXAO COM O BANCO DE DADOS
include('database.php');

// FUNCAO CENTRALIZADA PARA VERIFICAR PERFIL
function verificar_acesso($perfis_permitidos)
{
    if (!isset($_SESSION['perfil']) || !in_array($_SESSION['perfil'], $perfis_permitidos)) {
        header("Location: form_login.php");
        exit;
    }
}
?>