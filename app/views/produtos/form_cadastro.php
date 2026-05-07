<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: ../auth/form_login.php");
    exit;
}
$pagina_atual = 'estoque';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Produto - CEIControl</title>
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
                <h1>Novo Produto</h1>
                <p>Adicione um item ao estoque da unidade.</p>
            </div>
            <a href="listar.php" class="btn-sm secondary" style="text-decoration:none;">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </header>

        <section class="content-wrapper-centered">
            <div class="form-card-centered">
                <form action="processa_cadastro.php" method="POST" class="custom-form">

                    <div class="form-group">
                        <label><i class="fa-solid fa-box"></i> Nome do Produto</label>
                        <input type="text" name="nome" placeholder="Ex: Caderno de Desenho" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-align-left"></i> Descrição</label>
                        <textarea name="descricao" rows="2" placeholder="Breve detalhe do item..."></textarea>
                    </div>

                    <div style="display:flex;gap:15px;margin-bottom:20px;">
                        <div class="form-group" style="flex:1;margin-bottom:0;">
                            <label><i class="fa-solid fa-dollar-sign"></i> Preço Unitário</label>
                            <input type="number" step="0.01" name="preco" placeholder="0.00" required>
                        </div>
                        <div class="form-group" style="flex:1;margin-bottom:0;">
                            <label><i class="fa-solid fa-layer-group"></i> Quantidade</label>
                            <input type="number" name="quantidade" placeholder="0" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-finalizar">
                        <i class="fa-solid fa-check"></i> Cadastrar no Estoque
                    </button>
                </form>
            </div>
        </section>
    </main>
</div>
<script src="../../../public/script.js"></script>
</body>
</html>