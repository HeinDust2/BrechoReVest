<?php
// Inicia a sessão se ainda não estiver iniciada.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brechó Revest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" href="../public/assets/imagens/favicon.png" type="image/png">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Estilo do navbar */
        .navbar-custom {
            background-color: #5AA4FA;
        }
        /* Estilo do link de navegação ativo */
        .nav-link.active {
            font-weight: 600;
            color: #ffc107 !important;
        }
        /* Estilo para a foto de perfil */
        .profile-pic {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
        }
        .profile-pic-dropdown {
            margin-right: 8px; /* Espaço entre a foto e o texto */
        }
        /* ======================= */
        /* Estilos do modo acessibilidade */
        /* ======================= */
        body.accessibility-mode {
            font-size: 18px; /* aumenta fonte */
            background-color: #000 !important; /* fundo escuro */
            color: #fff !important; /* texto claro */
        }

        body.accessibility-mode a {
            color: #ffeb3b !important; /* links visíveis */
            font-weight: bold;
        }

        body.accessibility-mode .navbar-custom {
            background-color: #222 !important; /* navbar mais escura */
        }
        /* Espaçamento entre itens da navbar */
        .navbar-nav .nav-item {
            margin-right: 12px; /* espaço entre os itens */
        }

        /* Links da navbar (desktop) */
        .navbar-nav .nav-link {
            padding: 8px 14px;
            border-radius: 6px; /* cantos arredondados */
            transition: all 0.3s ease;
        }

        /* Hover: muda fundo e destaca texto */
        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff !important;
            transform: translateY(-2px); /* levanta um pouquinho */
        }

        /* Versão acessibilidade ativa */
        body.accessibility-mode .navbar-nav .nav-link:hover {
            background-color: #444 !important;
            color: #ffeb3b !important;
        }

        /* Estilo de foco para acessibilidade */
        .nav-link:focus,
        .dropdown-toggle:focus,
        .btn:focus,
        .navigatable-container:focus,
        .navigatable-container a:focus,
        .navigatable-container button:focus {
            outline: 2px solid #ffeb3b;
            outline-offset: 2px;
            box-shadow: 0 0 8px rgba(255, 235, 59, 0.7);
        }
        
        /* Acessibilidade para o dropdown-toggle */
        .dropdown-toggle.accessibility-mode {
            color: #ffeb3b !important;
        }

        /* Estilos para o atalho de teclado */
        .key-shortcut {
            font-family: monospace;
            background-color: rgba(0, 0, 0, 0.1);
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.8em;
            margin-left: 8px;
        }

        body.accessibility-mode .key-shortcut {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffeb3b;
        }
        .white-icon {
            /* Define o fundo como um SVG de ícone branco */
             background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
    </style>
</head>
<body>

<nav class="navbar navbar-custom navbar-expand-lg">
    <div class="container-fluid container">
        <a class="navbar-brand text-light" href="listar_produtos.php" style="font-weight: 600;">
            <i class="bi bi-shop me-2"></i> Brechó Revest
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon white-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 navigatable-container" tabindex="0">
                <li class="nav-item">
                    <a class="nav-link text-light text-nowrap" href="listar_produtos.php">
                        <i class="bi bi-tag me-2"></i> Comprar
                    </a>
                </li>
                <?php if (isset($_SESSION['usuario'])): ?>
                <li class="nav-item">
                    <a class="nav-link text-light text-nowrap" href="gerenciar_produto.php">
                        <i class="bi bi-plus-circle me-2"></i> Anunciar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light text-nowrap" href="meus_produtos.php">
                        <i class="bi bi-box-seam me-2"></i> Meus Anúncios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light text-nowrap" href="minhas_reservas.php">
                        <i class="bi bi-cart me-2"></i> Carrinho
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light text-nowrap" href="main_jornal.php">
                        <i class="bi bi-newspaper me-2"></i> Jornal
                    </a>
                </li>
                <?php endif; ?>
            </ul>
            <div class="d-flex align-items-center navigatable-container" tabindex="0">
                <button id="toggleAccessibility" class="btn btn-dark btn-sm me-2 text-nowrap">
                    <i class="bi bi-universal-access me-1"></i> Acessibilidade
                </button>

                <?php if (isset($_SESSION['usuario']['id'])): ?>
                    <div class="dropdown">
                        <a class="btn btn-outline-light d-flex align-items-center dropdown-toggle text-nowrap" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="userDropdown">
                            <?php if (isset($_SESSION['usuario']['foto_perfil']) && !empty($_SESSION['usuario']['foto_perfil'])): ?>
                                <img src="../public/uploads/<?= htmlspecialchars($_SESSION['usuario']['foto_perfil']) ?>" alt="Foto de perfil" class="profile-pic me-2">
                            <?php else: ?>
                                <i class="bi bi-person-circle fs-4 me-2"></i>
                            <?php endif; ?>
                            <?= htmlspecialchars($_SESSION['usuario']['nome'] ?? 'Usuário') ?>
                            <span class="key-shortcut d-none d-lg-inline">Alt + u</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">Olá, <?= htmlspecialchars($_SESSION['usuario']['nome'] ?? 'Usuário') ?>!</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="dashboard_vendedor.php">
                                    <i class="bi bi-graph-up me-2"></i> Painel Geral
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="editar_perfil.php">
                                    <i class="bi bi-person me-2"></i> Editar Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="ajuda.php">
                                    <i class="bi bi-life-preserver me-2"></i> Ajuda
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="autenticacao.php?acao=logout">
                                    <i class="bi bi-box-arrow-right me-2"></i> Sair
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="autenticacao.php?acao=login" class="btn btn-warning me-2 btn-sm text-nowrap" id="loginBtn">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        <span class="key-shortcut d-none d-lg-inline">Alt + l</span>
                    </a>
                    <a href="autenticacao.php?acao=cadastro" class="btn btn-success btn-sm text-nowrap" id="registerBtn">
                        <i class="bi bi-person-plus me-1"></i> Cadastrar
                        <span class="key-shortcut d-none d-lg-inline">Alt + c</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Seção de Acessibilidade
    // ------------------------------------
    const btnAccessibility = document.getElementById("toggleAccessibility");

    btnAccessibility.addEventListener("click", () => {
        document.body.classList.toggle("accessibility-mode");
        if (document.body.classList.contains("accessibility-mode")) {
            localStorage.setItem("accessibility", "on");
        } else {
            localStorage.removeItem("accessibility");
        }
    });

    window.addEventListener("load", () => {
        if (localStorage.getItem("accessibility") === "on") {
            document.body.classList.add("accessibility-mode");
        }
    });

    // Seção de Navegação via Teclado
    // ------------------------------------
    document.addEventListener('keydown', (event) => {
        // Atalhos globais
        if (event.altKey) {
            switch(event.key) {
                case 'n':
                    event.preventDefault();
                    document.querySelector('.navigatable-container .nav-link').focus();
                    break;
                case 'l':
                    event.preventDefault();
                    const loginBtn = document.getElementById('loginBtn');
                    if (loginBtn) loginBtn.focus();
                    break;
                case 'c':
                    event.preventDefault();
                    const registerBtn = document.getElementById('registerBtn');
                    if (registerBtn) registerBtn.focus();
                    break;
                case 'u':
                    event.preventDefault();
                    const userDropdown = document.getElementById('userDropdown');
                    if (userDropdown) userDropdown.focus();
                    break;
                case 'z':
                    event.preventDefault();
                    window.history.back();
                    break;
            }
        }

        // Navegação por setas em qualquer contêiner com a classe 'navigatable-container'
        const currentContainer = document.activeElement.closest('.navigatable-container');

        if (!currentContainer) {
            return;
        }
        
        const items = Array.from(currentContainer.querySelectorAll('a, button'));
        if (items.length === 0) {
            return;
        }
        
        const focusedItem = document.activeElement;
        let currentIndex = items.indexOf(focusedItem);

        if (event.key === 'ArrowRight' || event.key === 'ArrowDown') {
            event.preventDefault();
            const nextIndex = (currentIndex + 1) % items.length;
            items[nextIndex].focus();
        } else if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') {
            event.preventDefault();
            const prevIndex = (currentIndex - 1 + items.length) % items.length;
            items[prevIndex].focus();
        }
    });
</script>

</body>
</html>