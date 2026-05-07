<?php
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: /login");
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/UsuarioController.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if (isset($_SESSION['usuario_id']) && $id == $_SESSION['usuario_id']) {
        header("Location: /usuarios?erro=auto_exclusao");
        exit;
    }

    $controller = new UsuarioController($conn);
    $controller->excluir($id);
} else {
    header("Location: /usuarios");
    exit;
}
?>