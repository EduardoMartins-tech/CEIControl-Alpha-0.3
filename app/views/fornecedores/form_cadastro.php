<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: ../auth/form_login.php");
    exit;
}
$pagina_atual = 'fornecedores';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Fornecedor - CEIControl</title>
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
                <h1>Novo Fornecedor</h1>
                <p>Cadastre um novo parceiro no sistema.</p>
            </div>
            <a href="listar.php" class="btn-sm secondary" style="text-decoration:none;">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </header>

        <section class="content-wrapper-centered">
            <div class="form-card-centered">
                <form action="processa_cadastro.php" method="POST" class="custom-form">

                    <div class="form-group">
                        <label><i class="fa-solid fa-building"></i> Nome da Empresa / Fornecedor</label>
                        <input type="text" name="nome" placeholder="Ex: Papelaria Central" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-address-card"></i> CNPJ</label>
                        <input type="text" name="cnpj" placeholder="00.000.000/0000-00" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-envelope"></i> E-mail de Contato</label>
                        <input type="email" name="email" placeholder="contato@empresa.com">
                    </div>

                    <div class="form-group">
                        <label><i class="fa-solid fa-phone"></i> Telefone</label>
                        <input type="text" name="telefone" placeholder="(11) 0000-0000">
                    </div>

                    <button type="submit" class="btn-finalizar">
                        <i class="fa-solid fa-check"></i> Finalizar Cadastro
                    </button>
                </form>
            </div>
        </section>
    </main>
</div>
<script src="../../../public/script.js"></script>
</body>
</html>