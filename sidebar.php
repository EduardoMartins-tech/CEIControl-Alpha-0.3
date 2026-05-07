<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <span class="logo-text">CEIControl®</span>
        <button class="sidebar-close-btn" onclick="toggleSidebar()">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    
    <nav class="sidebar-nav">
        <p class="nav-category">Principal</p>
        
        <?php if ($_SESSION['perfil'] == 'admin'): ?>
            <a href="/app/views/auth/painel_admin.php" class="<?= ($pagina_atual == 'dashboard') ? 'active' : '' ?>">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>
            <p class="nav-category">Gestão</p>
            <a href="/app/views/usuarios/listar.php" class="<?= ($pagina_atual == 'usuarios') ? 'active' : '' ?>">
                <i class="fa-solid fa-users"></i> Usuários
            </a>
            <a href="/app/views/produtos/listar.php" class="<?= ($pagina_atual == 'estoque') ? 'active' : '' ?>">
                <i class="fa-solid fa-box-open"></i> Produtos
            </a>
            <a href="/app/views/fornecedores/listar.php" class="<?= ($pagina_atual == 'fornecedores') ? 'active' : '' ?>">
                <i class="fa-solid fa-truck-moving"></i> Fornecedores
            </a>
            <a href="/app/views/eventos/listar.php" class="<?= ($pagina_atual == 'agenda') ? 'active' : '' ?>">
                <i class="fa-solid fa-calendar-days"></i> Agenda
            </a>
        <?php elseif ($_SESSION['perfil'] == 'usuario'): ?>
            <a href="/app/views/auth/painel_usuario.php" class="<?= ($pagina_atual == 'dashboard') ? 'active' : '' ?>">
                <i class="fa-solid fa-chalkboard-user"></i> Minha Sala
            </a>
            <p class="nav-category">Rotina</p>
            <a href="/app/views/eventos/listar.php" class="<?= ($pagina_atual == 'agenda') ? 'active' : '' ?>">
                <i class="fa-solid fa-calendar-check"></i> Agenda Escolar
            </a>
            <a href="/app/views/produtos/listar.php" class="<?= ($pagina_atual == 'estoque') ? 'active' : '' ?>">
                <i class="fa-solid fa-box-archive"></i> Materiais
            </a>
        <?php elseif ($_SESSION['perfil'] == 'cliente'): ?>
            <a href="/app/views/auth/painel_cliente.php" class="<?= ($pagina_atual == 'dashboard') ? 'active' : '' ?>">
                <i class="fa-solid fa-house-user"></i> Visão Geral
            </a>
            <p class="nav-category">Acompanhamento</p>
            <a href="/app/views/eventos/listar.php" class="<?= ($pagina_atual == 'agenda') ? 'active' : '' ?>">
                <i class="fa-solid fa-calendar-day"></i> Agenda da CEI
            </a>
        <?php endif; ?>

        <p class="nav-category">Sistema</p>
        <a href="/app/views/comunicacao.php" class="nav-link <?= ($pagina_atual == 'comunicacao') ? 'active' : '' ?>">
            <i class="fa-solid fa-comments"></i>
            <span>Comunicação</span>
        </a>
        <a href="/app/views/auth/logout.php" class="logout-link">
            <i class="fa-solid fa-right-from-bracket"></i> Sair
        </a>
    </nav>

    <div class="theme-switch-wrapper">
        <i class="fa-solid fa-sun theme-icon-sm"></i>
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" onclick="toggleDarkMode()" />
            <div class="slider round"></div>
        </label>
        <i class="fa-solid fa-moon theme-icon-sm"></i>
    </div>
</aside>

<!-- Topbar mobile -->
<div class="mobile-topbar">
    <span class="logo-text">CEIControl®</span>
    <button class="hamburger-btn" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>
</div>

<!-- Overlay para fechar sidebar -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<script src="/public/script.js"></script>