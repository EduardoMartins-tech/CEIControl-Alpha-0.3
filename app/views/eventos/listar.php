<?php
session_start();
if (!isset($_SESSION['perfil']) || !in_array($_SESSION['perfil'], ['admin', 'cliente', 'usuario'])) {
    header("Location: ../auth/form_login.php");
    exit;
}

require_once __DIR__ . '/../../../config/database.php';

$pagina_atual = 'agenda';
$result = $conn->query("SELECT * FROM agenda ORDER BY data_evento ASC");
$pode_editar = ($_SESSION['perfil'] === 'admin');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Eventos - CEIControl</title>
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
                <h1>Agenda Escolar</h1>
                <p>Gerencie e visualize todos os eventos e atividades da CEI.</p>
            </div>
            <?php if ($pode_editar): ?>
            <a href="form_cadastro.php" class="btn-black-full" style="text-decoration:none !important;color:white !important;">
                <i class="fa-solid fa-plus"></i> Novo Evento
            </a>
            <?php endif; ?>
        </header>

        <section class="content-wrapper">
            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>DATA / HORA</th>
                            <th>TÍTULO E DESCRIÇÃO</th>
                            <th>PÚBLICO-ALVO</th>
                            <th>LOCAL</th>
                            <?php if ($pode_editar): ?>
                            <th style="text-align:center;">AÇÕES</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($evento = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <div style="display:flex;flex-direction:column;">
                                    <span style="font-weight:700;color:var(--text-main);"><?= date('d/m/Y', strtotime($evento['data_evento'])); ?></span>
                                    <span style="font-size:0.75rem;color:var(--text-sub);"><i class="fa-regular fa-clock"></i> <?= !empty($evento['hora_evento']) ? date('H:i', strtotime($evento['hora_evento'])) : '--:--'; ?></span>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight:600;color:var(--text-main);"><?= htmlspecialchars($evento['titulo']); ?></div>
                                <div style="font-size:0.8rem;color:var(--text-sub);max-width:250px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                    <?= htmlspecialchars($evento['descricao'] ?? ''); ?>
                                </div>
                            </td>
                            <td><span class="badge-agenda"><?= htmlspecialchars($evento['publico_alvo']); ?></span></td>
                            <td style="font-size:0.9rem;color:var(--text-sub);">
                                <i class="fa-solid fa-location-dot" style="font-size:0.75rem;color:#00a98f;"></i>
                                <?= htmlspecialchars($evento['local'] ?? 'Escola'); ?>
                            </td>
                            <?php if ($pode_editar): ?>
                            <td class="actions-cell">
                                <a href="editar.php?id=<?= $evento['id']; ?>" class="edit-btn"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="excluir.php?id=<?= $evento['id']; ?>" class="delete-btn" onclick="return confirm('Deseja excluir este evento?')"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align:center;padding:40px;color:var(--text-sub);">Nenhum evento agendado.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
<script src="../../../public/script.js"></script>
</body>
</html>