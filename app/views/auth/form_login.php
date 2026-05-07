<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CEIControl</title>
    <link rel="stylesheet" href="../../../public/style.css">
    <link rel="stylesheet" href="../../../public/mobile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/png" href="../../../public/assets/ceicontrol.png">
    <script defer src="../../../public/script.js"></script>
</head>
<body class="bg-auth">
    <div class="auth-split-wrapper">
        <div class="auth-side-form">
            <div class="auth-container">
                <header class="auth-header">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <a href="../../../public/index.php" class="logo-text">CEIControl®</a>
                        <div class="theme-switch-wrapper" style="margin-top:0;border-top:none;padding:0;">
                            <i class="fa-solid fa-sun theme-icon-sm"></i>
                            <label class="theme-switch" for="checkbox">
                                <input type="checkbox" id="checkbox" onclick="toggleDarkMode()"/>
                                <div class="slider round"></div>
                            </label>
                            <i class="fa-solid fa-moon theme-icon-sm"></i>
                        </div>
                    </div>
                </header>

                <main class="auth-card">
                    <h2>Entrar no Sistema</h2>
                    <p class="subtitle">Bem-vindo de volta! Insira os seus dados para aceder ao painel.</p>

                    <?php if (isset($_GET['erro'])): ?>
                        <div class="error-msg">E-mail, senha ou perfil inválidos.</div>
                    <?php endif; ?>

                    <form action="login_user.php" method="POST" class="auth-form">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" placeholder="seu@email.com" required>

                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="••••••••" required>

                        <label for="perfil">Perfil de Acesso</label>
                        <select name="perfil" id="perfil" required>
                            <option value="" disabled selected>Selecione o seu perfil</option>
                            <option value="admin">Gestor Escolar</option>
                            <option value="cliente">Responsável/Pais</option>
                            <option value="usuario">Educador/Professor</option>
                        </select>

                        <button type="submit" class="btn-black-full">Entrar na plataforma</button>
                    </form>

                    <footer class="auth-footer">
                        <p>Problemas com o acesso?<br>
                        <a href="../../../public/index.php#contato">Contacte o suporte da JEMTech</a></p>
                    </footer>
                </main>
            </div>
        </div>

        <div class="auth-side-visual">
            <div class="visual-content">
                <h2>Gestão inteligente para uma educação transformadora.</h2>
                <p>Centralize processos, economize tempo e foque no desenvolvimento dos seus alunos com a tecnologia da JEMTech.</p>
                <div class="visual-footer">
                    <img src="../../../public/assets/logo_jemtech.png" alt="Logo JEMTech" class="footer-logo">
                    <img src="../../../public/assets/logo_fatec.jpg" alt="Logo FATEC" class="footer-logo">
                    <div class="footer-text">
                        <span>Powered by JEMTech & FATEC</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>