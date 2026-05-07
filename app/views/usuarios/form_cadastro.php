<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: ../auth/form_login.php");
    exit;
}

$pagina_atual = 'usuarios';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário - CEIControl</title>
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
                <h1>Novo Usuário</h1>
                <p>Preencha os dados abaixo para registrar no sistema.</p>
            </div>
            <a href="listar.php" class="btn-black-full" style="width:auto;padding:10px 25px;background:#666;">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </header>

        <?php if (isset($_GET['erro']) && $_GET['erro'] == 'email_duplicado'): ?>
            <div class="alert-danger" style="max-width:600px;margin:0 auto 20px auto;">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>Este e-mail já está cadastrado no sistema.</span>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['erro']) && $_GET['erro'] == 'sistema'): ?>
            <div class="alert-danger" style="max-width:600px;margin:0 auto 20px auto;">
                <i class="fa-solid fa-circle-xmark"></i>
                <span>Erro ao processar cadastro. Tente novamente.</span>
            </div>
        <?php endif; ?>

        <section class="content-wrapper">
            <div class="admin-card" style="max-width:600px;margin:0 auto;display:block;">
                <form action="processa_cadastro.php" method="POST" class="custom-form">

                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" name="nome" id="nome" placeholder="Digite o nome" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" placeholder="email@exemplo.com" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Crie uma senha" required>
                    </div>

                    <div class="form-group">
                        <label for="perfil">Perfil de Acesso</label>
                        <select name="perfil" id="perfil" required>
                            <option value="admin">Gestor Escolar (Admin)</option>
                            <option value="cliente">Responsável (Cliente)</option>
                            <option value="usuario">Educador (Usuário)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-black-full" style="width:100%;margin-top:20px;">
                        <i class="fa-solid fa-user-plus"></i> Finalizar Cadastro
                    </button>
                </form>
            </div>
        </section>
    </main>
</div>
<script src="../../../public/script.js"></script>
</body>
</html>