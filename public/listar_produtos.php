<?php
// Exibir erros para debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inclui conexão (ajuste o caminho conforme sua estrutura!)

include __DIR__ . '/../app/core/conexao.php';

include __DIR__ . '/../app/includes/header.php';


include __DIR__ . '/../app/logic/filtro_produto.php';
include __DIR__ . '/../app/views/filtro_produto.php';

?>