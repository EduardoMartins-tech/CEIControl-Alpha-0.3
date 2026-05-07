<?php
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'usuario') {
    header("Location: /login");
    exit;
}
$pagina_atual = 'dashboard';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Educador - CEIControl</title>
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
                <h1>Olá, Prof(a). <?= htmlspecialchars($_SESSION['nome']); ?></h1>
                <p>Espaço de gestão pedagógica e rotina escolar.</p>
            </div>
        </header>

        <section class="content-wrapper">
            <div class="welcome-banner">
                <h2>Gestão de Atividades</h2>
                <p>Gerencie os eventos e a comunicação com os responsáveis.</p>
            </div>

            <div class="grid-funcionalidades">
                <div class="admin-card">
                    <div class="card-icon" style="background:#ebf4ff;color:#4a90e2;">
                        <i class="fa-solid fa-calendar-plus"></i>
                    </div>
                    <div class="card-info">
                        <h3>Agenda e Eventos</h3>
                        <p>Visualize ou adicione atividades ao calendário escolar.</p>
                        <div class="card-actions">
                            <a href="/eventos/cadastro" class="btn-sm primary">Novo Evento</a>
                            <a href="/eventos" class="btn-sm">Ver Tudo</a>
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <div class="card-icon" style="background:#ebf4ff;color:#4a90e2;">
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <div class="card-info">
                        <h3>Comunicados</h3>
                        <p>Envie avisos para os responsáveis ou fale com a gestão.</p>
                        <div class="card-actions">
                            <a href="/comunicacao" class="btn-sm primary">Abrir Chat</a>
                        </div>
                    </div>
                </div>

                <div class="admin-card full-width">
                    <div class="card-icon" style="background:#f0f4f8;color:#64748b;">
                        <i class="fa-solid fa-box-archive"></i>
                    </div>
                    <div class="card-info">
                        <h3>Materiais e Estoque</h3>
                        <p>Consulte a lista de produtos e materiais pedagógicos disponíveis.</p>
                        <div class="card-actions">
                            <a href="/produtos" class="btn-sm">Consultar Materiais</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
<script src="../../../public/script.js"></script>
</body>
</html>