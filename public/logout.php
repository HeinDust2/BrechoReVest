

<?php
// Inicia a sessão se ainda não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Destrói todas as variáveis de sessão
session_unset();

// Destrói a sessão
session_destroy();

// Redireciona o usuário para a página de login
header('Location: autenticacao.php?acao=login');
exit(); // Garante que o script pare de executar após o redirecionamento
?>