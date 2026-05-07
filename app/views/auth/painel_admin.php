<?php
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
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
    <title>Painel Administrativo - CEIControl</title>
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
                <h1>Painel Administrativo</h1>
                <p>Olá, bem-vindo ao centro de controle da CEI.</p>
            </div>
        </header>

        <section class="content-wrapper">
            <div class="welcome-banner">
                <h2>O que você deseja gerenciar hoje?</h2>
            </div>

            <div class="grid-funcionalidades">
                <div class="admin-card">
                    <div class="card-icon"><i class="fa-solid fa-user-shield"></i></div>
                    <div class="card-info">
                        <h3>Usuários</h3>
                        <p>Controle de acessos e perfis.</p>
                        <div class="card-actions">
                            <a href="/usuarios/cadastro" class="btn-sm primary">Cadastrar</a>
                            <a href="/usuarios" class="btn-sm">Listar</a>
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <div class="card-icon"><i class="fa-solid fa-box"></i></div>
                    <div class="card-info">
                        <h3>Produtos e Serviços</h3>
                        <p>Gestão de itens e inventário.</p>
                        <div class="card-actions">
                            <a href="/produtos/cadastro" class="btn-sm primary">Cadastrar</a>
                            <a href="/produtos" class="btn-sm">Listar</a>
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <div class="card-icon"><i class="fa-solid fa-truck-fast"></i></div>
                    <div class="card-info">
                        <h3>Fornecedores</h3>
                        <p>Logística e parceiros.</p>
                        <div class="card-actions">
                            <a href="/fornecedores/cadastro" class="btn-sm primary">Cadastrar</a>
                            <a href="/fornecedores" class="btn-sm">Listar</a>
                        </div>
                    </div>
                </div>

                <div class="admin-card">
                    <div class="card-icon"><i class="fa-solid fa-calendar-check"></i></div>
                    <div class="card-info">
                        <h3>Agenda</h3>
                        <p>Eventos e cronograma escolar.</p>
                        <div class="card-actions">
                            <a href="/eventos/cadastro" class="btn-sm primary">Cadastrar</a>
                            <a href="/eventos" class="btn-sm">Listar</a>
                        </div>
                    </div>
                </div>

                <div class="admin-card full-width">
                    <div class="card-icon"><i class="fa-solid fa-comments"></i></div>
                    <div class="card-info">
                        <h3>Comunicação</h3>
                        <p>Acesse as mensagens e comunicados internos.</p>
                        <div class="card-actions">
                            <a href="/comunicacao" class="btn-sm primary">Acessar Mensagens</a>
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