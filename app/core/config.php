<?php
// config.php - arquivo central para includes e config geral

// Inicia sessão se não estiver ativa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Define caminho base para facilitar includes
define('APP_PATH', __DIR__ . '/../');
define('INCLUDES_PATH', APP_PATH . 'includes/');
define('CORE_PATH', APP_PATH . 'core/');

// Inclui arquivos essenciais
include CORE_PATH . 'conexao.php';
include INCLUDES_PATH . 'header.php';
include INCLUDES_PATH . 'footer.php';
include INCLUDES_PATH . 'verifica_login.php';

// Você pode incluir outros arquivos que sejam essenciais aqui também
