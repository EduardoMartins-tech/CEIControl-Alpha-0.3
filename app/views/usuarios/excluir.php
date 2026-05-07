<?php
session_start();

if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    exit("Acesso negado");
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/UsuarioController.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Impede que o admin logado se exclua
    if (isset($_SESSION['usuario_id']) && $id == $_SESSION['usuario_id']) {
        header("Location: listar.php?erro=auto_exclusao");
        exit;
    }

    $controller = new UsuarioController($conn);
    $controller->excluir($id);
} else {
    header("Location: listar.php");
    exit;
}
?>