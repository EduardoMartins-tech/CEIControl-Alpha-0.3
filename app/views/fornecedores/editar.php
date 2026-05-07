<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: ../auth/form_login.php");
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/FornecedorController.php';

if (!isset($_GET['id'])) {
    header("Location: listar.php?erro=id_invalido");
    exit;
}

$controller  = new FornecedorController($conn);
$fornecedor  = $controller->buscar((int)$_GET['id']);

if (!$fornecedor) {
    header("Location: listar.php?erro=nao_encontrado");
    exit;
}

$pagina_atual = 'fornecedores';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Fornecedor - CEIControl</title>
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
                <h1>Editar Fornecedor</h1>
                <p>Modificando: <strong><?= htmlspecialchars($fornecedor['nome']) ?></strong></p>
            </div>
            <a href="listar.php" class="btn-black-full" style="width:auto;padding:10px 25px;background:#666;">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </header>

        <section class="content-wrapper">
            <div class="admin-card" style="max-width:600px;margin:0 auto;display:block;">
                <form action="atualizar.php" method="POST" class="custom-form">
                    <input type="hidden" name="id" value="<?= $fornecedor['id'] ?>">

                    <div class="form-group">
                        <label><i class="fa-solid fa-building"></i> Nome da Empresa</label>
                        <input type="text" name="nome" value="<?= htmlspecialchars($fornecedor['nome']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-address-card"></i> CNPJ</label>
                        <input type="text" name="cnpj" value="<?= htmlspecialchars($fornecedor['cnpj']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-envelope"></i> E-mail de Contato</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($fornecedor['email']) ?>">
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-phone"></i> Telefone</label>
                        <input type="text" name="telefone" value="<?= htmlspecialchars($fornecedor['telefone']) ?>">
                    </div>

                    <button type="submit" class="btn-black-full" style="width:100%;margin-top:20px;">
                        <i class="fa-solid fa-save"></i> Atualizar Fornecedor
                    </button>
                </form>
            </div>
        </section>
    </main>
</div>
<script src="../../../public/script.js"></script>
</body>
</html>