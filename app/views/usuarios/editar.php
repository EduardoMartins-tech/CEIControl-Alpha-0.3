<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: ../auth/form_login.php");
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/UsuarioController.php';

if (!isset($_GET['id'])) {
    header("Location: listar.php?erro=id_invalido");
    exit;
}

$controller = new UsuarioController($conn);
$usuario = $controller->buscar((int)$_GET['id']);

if (!$usuario) {
    header("Location: listar.php?erro=usuario_nao_encontrado");
    exit;
}

$pagina_atual = 'usuarios';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário - CEIControl</title>
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
                <h1>Editar Cadastro</h1>
                <p>Modificando os dados de: <strong><?= htmlspecialchars($usuario['nome']) ?></strong></p>
            </div>
            <a href="listar.php" class="btn-black-full" style="width:auto;padding:10px 25px;background:#666;">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </header>

        <section class="content-wrapper">
            <div class="admin-card" style="max-width:600px;margin:0 auto;display:block;">
                <form action="atualizar.php" method="POST" class="custom-form">
                    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail de Acesso</label>
                        <input type="email" name="email" id="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="perfil">Perfil de Acesso</label>
                        <select name="perfil" id="perfil" required>
                            <option value="admin"   <?= $usuario['perfil'] === 'admin'   ? 'selected' : '' ?>>Gestor Escolar (Admin)</option>
                            <option value="cliente" <?= $usuario['perfil'] === 'cliente' ? 'selected' : '' ?>>Responsável (Cliente)</option>
                            <option value="usuario" <?= $usuario['perfil'] === 'usuario' ? 'selected' : '' ?>>Educador (Usuário)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="senha">Nova Senha (deixe em branco para não alterar)</label>
                        <input type="password" name="senha" id="senha" placeholder="********">
                    </div>

                    <button type="submit" class="btn-black-full" style="width:100%;margin-top:20px;">
                        <i class="fa-solid fa-save"></i> Atualizar Dados
                    </button>
                </form>
            </div>
        </section>
    </main>
</div>
<script src="../../../public/script.js"></script>
</body>
</html>