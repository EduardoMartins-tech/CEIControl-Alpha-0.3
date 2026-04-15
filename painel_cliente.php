<?php
session_start();
// Proteção de acesso: garante que só clientes entrem aqui
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'cliente') {
    header("Location: form_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Responsável - CEIControl</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard-body">

    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-logo">
                <span class="logo-text">CEIControl®</span>
            </div>
            
            <nav class="sidebar-nav">
                <p class="nav-category">Início</p>
                <a href="painel_cliente.php" class="active"><i class="fa-solid fa-house-user"></i> Visão Geral</a>
                
                <p class="nav-category">Acompanhamento</p>
                <a href="listar_eventos.php"><i class="fa-solid fa-calendar-day"></i> Agenda da CEI</a>
                <a href="mensagens.php"><i class="fa-solid fa-comments"></i> Comunicação</a>
                
                <p class="nav-category">Conta</p>
                <a href="logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
            </nav>
        </aside>

        <main class="main-content">
            <header class="dash-header">
                <div class="header-welcome">
                    <h1>Bem-vindo(a), <?= $_SESSION['nome']; ?>!</h1>
                    <p>Aqui você acompanha a rotina escolar do seu filho(a).</p>
                </div>
                <div class="header-profile">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['nome']); ?>&background=00a98f&color=fff" alt="Perfil">
                </div>
            </header>

            <section class="content-wrapper">
                <div class="welcome-banner">
                    <h2>Serviços Disponíveis</h2>
                </div>

                <div class="grid-funcionalidades">
                    <div class="admin-card">
                        <div class="card-icon" style="background: #e6f4f1; color: var(--light-green);">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <div class="card-info">
                            <h3>Agenda Escolar</h3>
                            <p>Confira feriados, reuniões e eventos especiais da unidade.</p>
                            <div class="card-actions">
                                <a href="listar_eventos.php" class="btn-sm primary">Ver Agenda da CEI</a>
                            </div>
                        </div>
                    </div>

                    <div class="admin-card">
                        <div class="card-icon" style="background: #e6f4f1; color: var(--light-green);">
                            <i class="fa-solid fa-comment-dots"></i>
                        </div>
                        <div class="card-info">
                            <h3>Comunicação</h3>
                            <p>Fale diretamente com a coordenação ou veja avisos importantes.</p>
                            <div class="card-actions">
                                <a href="mensagens.php" class="btn-sm primary">Acessar Mensagens</a>
                            </div>
                        </div>
                    </div>

                    <div class="admin-card full-width">
                        <div class="card-icon" style="background: #f0f9f7; color: var(--primary-green);">
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

</body>
</html>