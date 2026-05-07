<?php
session_start();
if (!isset($_SESSION['perfil']) || !in_array($_SESSION['perfil'], ['admin', 'usuario'])) {
    header("Location: ../auth/form_login.php");
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/EventoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo      = trim($_POST['titulo']      ?? '');
    $descricao   = trim($_POST['descricao']   ?? '');
    $data_evento = trim($_POST['data_evento'] ?? '');
    $hora_evento = trim($_POST['hora_evento'] ?? '');
    $local       = trim($_POST['local']       ?? '');
    $publico_alvo = trim($_POST['publico_alvo'] ?? 'Geral');
    $criado_por  = $_SESSION['usuario_id'];

    if (!$titulo || !$data_evento) {
        header("Location: form_cadastro.php?erro=campos_vazios");
        exit;
    }

    $controller = new EventoController($conn);
    $controller->cadastrar($titulo, $descricao, $data_evento, $hora_evento, $local, $criado_por, $publico_alvo);
} else {
    header("Location: form_cadastro.php");
    exit;
}
?>