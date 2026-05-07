<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'cliente') {
    header("Location: form_login.php");
    exit;
}
$pagina_atual = 'dashboard';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Responsável - CEIControl</title>
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
                <h1>Bem-vindo(a), <?= htmlspecialchars($_SESSION['nome']); ?>!</h1>
                <p>Aqui você acompanha a rotina escolar do seu filho(a).</p>
            </div>
        </header>

        <section class="content-wrapper">
            <div class="welcome-banner">
                <h2>Serviços Disponíveis</h2>
            </div>

            <div class="grid-funcionalidades">
                <div class="admin-card">
                    <div class="card-icon" style="background:#e6f4f1;color:#00a98f;">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div class="card-info">
                        <h3>Agenda Escolar</h3>
                        <p>Confira feriados, reuniões e eventos especiais da unidade.</p>
                        <div class="card-actions">
                            <a href="../eventos/listar.php" class="btn-sm primary">Ver Agenda da CEI</a>
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <div class="card-icon" style="background:#e6f4f1;color:#00a98f;">
                        <i class="fa-solid fa-comment-dots"></i>
                    </div>
                    <div class="card-info">
                        <h3>Comunicação</h3>
                        <p>Fale diretamente com a coordenação ou veja avisos importantes.</p>
                        <div class="card-actions">
                            <a href="../comunicacao.php" class="btn-sm primary">Acessar Mensagens</a>
                        </div>
                    </div>
                </div>

                <div class="admin-card full-width">
                    <div class="card-icon" style="background:#f0f9f7;color:#007a68;">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>
                    <div class="card-info">
                        <h3>Segurança e Atualização</h3>
                        <p>Para sua segurança, mantenha seus dados de contato e do aluno sempre atualizados junto à secretaria da CEI.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
<script src="../../../public/script.js"></script>
</body>
</html>