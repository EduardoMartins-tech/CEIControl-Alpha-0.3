<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: /app/views/auth/form_login.php");
    exit;
}

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../app/controllers/MensagemController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destinatario_id = intval($_POST['destinatario_id'] ?? 0);
    $mensagem        = trim($_POST['mensagem'] ?? '');
    $remetente_id    = $_SESSION['usuario_id'];

    if ($destinatario_id > 0 && !empty($mensagem)) {
        require_once __DIR__ . '/../../app/models/MensagemModel.php';
        $model = new MensagemModel($conn);
        $model->enviar($remetente_id, $destinatario_id, $mensagem);
    }

    header("Location: /app/views/comunicacao.php?id_contato=$destinatario_id");
    exit;
}

header("Location: /app/views/comunicacao.php");
exit;
?>