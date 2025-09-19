<?php
// Inicia a sessão se ainda não estiver ativa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclui a conexão com o banco de dados e o header
include __DIR__ . '/../core/conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensagem'] = "Você precisa estar logado para ver suas reservas.";
    $_SESSION['tipo_mensagem'] = "warning";
    header('Location: autenticacao.php?acao=login');
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];

// SQL para buscar produtos reservados pelo usuário logado
// A busca é feita na tabela 'produtos', usando a coluna 'usuario_id'
// Adicionamos 'u.id AS usuario_id' e 'u.telefone' para o novo botão de contato
$usuario_id = $_SESSION['usuario']['id'];

// SQL corrigido para buscar produtos reservados PELO usuário logado (comprador)
$sql = "SELECT 
            p.id, 
            p.nome, 
            p.preco, 
            p.imagem,
            p.data_cadastro,
            u.nome AS nome_loja, 
            u.id AS usuario_id, 
            u.telefone
        FROM 
            produtos p
        JOIN 
            usuarios u ON p.usuario_id = u.id
        WHERE 
            p.comprador_id = ? AND p.status_reserva = 'reservado'";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
include __DIR__ . '/../includes/header.php';
// O código para exibir o HTML e os dados da tabela viria aqui abaixo.
?>