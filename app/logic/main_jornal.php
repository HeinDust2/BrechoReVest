<?php
// Inicia a sessão se ainda não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



// Conexão com o banco de dados. Certifique-se de que o caminho está correto.
require_once __DIR__ . '/../core/conexao.php';

// Consulta para buscar as últimas notícias, ordenadas pela data mais recente
$sql_noticias = "SELECT id, autor, resumo, corpo_do_texto, data_de_publicacao, referencias, imagem FROM noticias ORDER BY data_de_publicacao DESC LIMIT 5";
$resultado_noticias = $con->query($sql_noticias);

// Consulta para buscar os próximos eventos, ordenados pela data mais próxima
$sql_eventos = "SELECT id, nome_evento, data_inicio_evento, data_termino_evento, hora_evento, local_evento, descricao_evento, imagem_evento, confirmacoes FROM eventos ORDER BY data_inicio_evento ASC LIMIT 5";
$resultado_eventos = $con->query($sql_eventos);
?>
<?php
include __DIR__ . '/../includes/header.php';
?>

