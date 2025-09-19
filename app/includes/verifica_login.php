<?php
// verifica_login.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário não está logado
if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id'])) {
    // Redireciona para a página de login
    header('Location: auth.php?erro=nao_logado');
    exit(); // É crucial usar exit() após um redirecionamento
}

// Se o usuário estiver logado, o script continua normalmente
?>