<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: ../auth/form_login.php");
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/EventoController.php';

if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit;
}

$controller = new EventoController($conn);
$evento = $controller->buscar((int)$_GET['id']);

if (!$evento) {
    header("Location: listar.php?erro=nao_encontrado");
    exit;
}

$pagina_atual = 'agenda';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento - CEIControl</title>
    <link rel="stylesheet" href="../../../public/style.css">
    <link rel="stylesheet" href="../../../public/mobile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="../../../public/assets/ceicontrol.png">
</head>
<body class="dashboard-body">
<div class="dashboard-container">
    <?php include __DIR__ . '/../../../sidebar.php'; ?>

    <main class="main-content">
        <header class="dash-header">
            <div class="header-welcome">
                <h1>Editar Evento</h1>
                <p>Gerencie as informações da agenda escolar.</p>
            </div>
            <a href="listar.php" class="btn-sm secondary" style="text-decoration:none;">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </header>

        <section class="content-wrapper-centered">
            <div class="form-card-centered">
                <form action="atualizar.php" method="POST" class="custom-form">
                    <input type="hidden" name="id" value="<?= $evento['id']; ?>">

                    <div class="form-group">
                        <label><i class="fa-solid fa-tag"></i> Título do Evento</label>
                        <input type="text" name="titulo" value="<?= htmlspecialchars($evento['titulo']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-align-left"></i> Descrição</label>
                        <textarea name="descricao" rows="3"><?= htmlspecialchars($evento['descricao'] ?? ''); ?></textarea>
                    </div>

                    <div style="display:flex;gap:15px;margin-bottom:20px;">
                        <div class="form-group" style="flex:1;margin-bottom:0;">
                            <label><i class="fa-solid fa-calendar"></i> Data</label>
                            <input type="date" name="data_evento" value="<?= $evento['data_evento']; ?>" required>
                        </div>
                        <div class="form-group" style="flex:1;margin-bottom:0;">
                            <label><i class="fa-solid fa-clock"></i> Hora</label>
                            <input type="time" name="hora_evento" value="<?= $evento['hora_evento'] ?? ''; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-location-dot"></i> Local</label>
                        <input type="text" name="local" value="<?= htmlspecialchars($evento['local'] ?? ''); ?>" placeholder="Ex: Pátio Central">
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-users"></i> Público Alvo</label>
                        <select name="publico_alvo">
                            <option value="Geral"        <?= ($evento['publico_alvo'] == 'Geral')        ? 'selected' : ''; ?>>Geral (Todos)</option>
                            <option value="Pais"          <?= ($evento['publico_alvo'] == 'Pais')         ? 'selected' : ''; ?>>Apenas Pais</option>
                            <option value="Funcionários"  <?= ($evento['publico_alvo'] == 'Funcionários') ? 'selected' : ''; ?>>Apenas Funcionários</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-finalizar">
                        <i class="fa-solid fa-check"></i> Salvar Alterações
                    </button>
                </form>
            </div>
        </section>
    </main>
</div>
<script src="../../../public/script.js"></script>
</body>
</html>