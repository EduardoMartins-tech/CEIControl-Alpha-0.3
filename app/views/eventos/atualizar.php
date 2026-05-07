<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: ../auth/form_login.php");
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/EventoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id          = intval($_POST['id']          ?? 0);
    $titulo      = trim($_POST['titulo']        ?? '');
    $descricao   = trim($_POST['descricao']     ?? '');
    $data_evento = trim($_POST['data_evento']   ?? '');
    $hora_evento = trim($_POST['hora_evento']   ?? '');
    $local       = trim($_POST['local']         ?? '');
    $publico_alvo = trim($_POST['publico_alvo'] ?? 'Geral');

    if ($id === 0 || !$titulo || !$data_evento) {
        header("Location: listar.php?erro=dados_invalidos");
        exit;
    }

    $controller = new EventoController($conn);
    $controller->atualizar($id, $titulo, $descricao, $data_evento, $hora_evento, $local, $publico_alvo);
} else {
    header("Location: listar.php");
    exit;
}
?>