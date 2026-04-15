<?php
session_start();
// Proteção: garante que apenas quem tem perfil 'usuario' (Educador) acesse
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'usuario') {
    header("Location: form_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Educador - CEIControl</title>
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
                <p class="nav-category">Principal</p>
                <a href="painel_usuario.php" class="active"><i class="fa-solid fa-chalkboard-user"></i> Minha Sala</a>
                
                <p class="nav-category">Rotina</p>
                <a href="listar_eventos.php"><i class="fa-solid fa-calendar-check"></i> Agenda Escolar</a>
                <a href="mensagens.php"><i class="fa-solid fa-paper-plane"></i> Comunicados</a>
                
                <p class="nav-category">Conta</p>
                <a href="logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
            </nav>
        </aside>

        <main class="main-content">
            <header class="dash-header">
                <div class="header-welcome">
                    <h1>Olá, Prof(a). <?= $_SESSION['nome']; ?></h1>
                    <p>Espaço de gestão pedagógica e rotina escolar.</p>
                </div>
                <div class="header-profile">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['nome']); ?>&background=4a90e2&color=fff" alt="Perfil">
                </div>
            </header>

            <section class="content-wrapper">
                <div class="welcome-banner">
                    <h2>Gestão de Atividades</h2>
                    <p>Gerencie os eventos e a comunicação com os responsáveis.</p>
                </div>

                <div class="grid-funcionalidades">
                    <div class="admin-card">
                        <div class="card-icon" style="background: #ebf4ff; color: #4a90e2;">
                            <i class="fa-solid fa-calendar-plus"></i>
                        </div>
                        <div class="card-info">
                            <h3>Agenda e Eventos</h3>
                            <p>Visualize ou adicione atividades ao calendário escolar.</p>
                            <div class="card-actions">
                                <a href="form_cadastro_evento.php" class="btn-sm primary">Novo Evento</a>
                                <a href="listar_eventos.php" class="btn-sm">Ver Tudo</a>
                            </div>
                        </div>
                    </div>

                    <div class="admin-card">
                        <div class="card-icon" style="background: #ebf4ff; color: #4a90e2;">
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </div>
                        <div class="card-info">
                            <h3>Comunicados</h3>
                            <p>Envie avisos para os responsáveis ou fale com a gestão.</p>
                            <div class="card-actions">
                                <a href="mensagens.php" class="btn-sm primary">Enviar Mensagem</a>
                            </div>
                        </div>
                    </div>

                    <div class="admin-card full-width">
                        <div class="card-icon" style="background: #f0f4f8; color: #64748b;">
                            <i class="fa-solid fa-box-archive"></i>
                        </div>
                        <div class="card-info">
                            <h3>Materiais e Estoque</h3>
                            <p>Consulte a lista de produtos e materiais pedagógicos disponíveis na unidade.</p>
                            <div class="card-actions">
                                <a href="listar_produtos.php" class="btn-sm">Consultar Materiais</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

</body>
</html>