<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['perfil'])) {
    header("Location: form_login.php");
    exit;
}

// DEFINE QUEM PODE VER ESSA PÁGINA:
// Queremos que tanto o 'admin' (Gestor) quanto o 'usuario' (Educador) acessem.
$perfis_permitidos = ['admin', 'usuario'];

if (!in_array($_SESSION['perfil'], $perfis_permitidos)) {
    // Se um 'cliente' (Pai) tentar entrar, ele é mandado de volta pro painel dele
    header("Location: painel_cliente.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Produtos e Serviços</title>
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>

    <h2>Produtos e Serviços Cadastrados</h2>
    <p><a href="painel_admin.php">Voltar ao painel</a></p>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= ucfirst($row['tipo']) ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td><?= $row['descricao'] ?></td>
                    <td>R$ <?= number_format($row['preco'], 2, ',', '.') ?></td>
                    <td><?= $row['tipo'] === 'produto' ? $row['quantidade'] : '-' ?></td>
                    <td><?= date('d/m/Y', strtotime($row['data_cadastro'])) ?></td>
                    <td>
                        <a href="editar_produto.php?id=<?= $row['id'] ?>">Editar</a> |
                        <a href="excluir_produto.php?id=<?= $row['id'] ?>"
                            onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>

</html>