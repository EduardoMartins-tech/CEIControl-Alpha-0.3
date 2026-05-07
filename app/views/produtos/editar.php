<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: ../auth/form_login.php");
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/ProdutoController.php';

if (!isset($_GET['id'])) {
    header("Location: listar.php?erro=id_invalido");
    exit;
}

$controller = new ProdutoController($conn);
$produto = $controller->buscar((int)$_GET['id']);

if (!$produto) {
    header("Location: listar.php?erro=nao_encontrado");
    exit;
}

$pagina_atual = 'estoque';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto - CEIControl</title>
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
                <h1>Editar Produto</h1>
                <p>Modificando: <strong><?= htmlspecialchars($produto['nome']) ?></strong></p>
            </div>
            <a href="listar.php" class="btn-black-full" style="width:auto;padding:10px 25px;background:#666;">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </header>

        <section class="content-wrapper">
            <div class="admin-card" style="max-width:600px;margin:0 auto;display:block;">
                <form action="atualizar.php" method="POST" class="custom-form">
                    <input type="hidden" name="id" value="<?= $produto['id'] ?>">

                    <div class="form-group">
                        <label for="nome"><i class="fa-solid fa-box"></i> Nome do Produto</label>
                        <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="descricao"><i class="fa-solid fa-align-left"></i> Descrição</label>
                        <textarea name="descricao" id="descricao" rows="2"><?= htmlspecialchars($produto['descricao'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="preco"><i class="fa-solid fa-dollar-sign"></i> Preço Unitário</label>
                        <input type="number" step="0.01" name="preco" id="preco" value="<?= $produto['preco'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="quantidade"><i class="fa-solid fa-layer-group"></i> Quantidade</label>
                        <input type="number" name="quantidade" id="quantidade" value="<?= $produto['quantidade'] ?>" required>
                    </div>

                    <button type="submit" class="btn-black-full" style="width:100%;margin-top:20px;">
                        <i class="fa-solid fa-save"></i> Atualizar Produto
                    </button>
                </form>
            </div>
        </section>
    </main>
</div>
<script src="../../../public/script.js"></script>
</body>
</html>