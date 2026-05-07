<?php
session_start();
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'admin') {
    header("Location: ../auth/form_login.php");
    exit;
}

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/controllers/FornecedorController.php';

$controller = new FornecedorController($conn);
$resultado  = $controller->listar();
$pagina_atual = 'fornecedores';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fornecedores - CEIControl</title>
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
                <h1>Fornecedores</h1>
                <p>Gestão de parceiros e fornecedores da unidade.</p>
            </div>
            <a href="form_cadastro.php" class="btn-black-full" style="width:auto;padding:10px 20px;">
                <i class="fa-solid fa-plus"></i> Novo Fornecedor
            </a>
        </header>

        <section class="content-wrapper">
            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CNPJ</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th style="text-align:center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultado->num_rows === 0): ?>
                        <tr>
                            <td colspan="5" style="text-align:center;padding:30px;color:#888;">Nenhum fornecedor cadastrado.</td>
                        </tr>
                        <?php else: ?>
                        <?php while($f = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($f['nome']); ?></strong></td>
                            <td><?= htmlspecialchars($f['cnpj']); ?></td>
                            <td><?= htmlspecialchars($f['email']); ?></td>
                            <td><?= htmlspecialchars($f['telefone']); ?></td>
                            <td class="actions-cell">
                                <a href="editar.php?id=<?= $f['id']; ?>" class="edit-btn" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="excluir.php?id=<?= $f['id']; ?>" class="delete-btn" title="Excluir" onclick="return confirm('Excluir este fornecedor?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
<script src="../../../public/script.js"></script>
</body>
</html>