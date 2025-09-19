<?php
// Inicia a sessão se ainda não estiver ativa.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclui o cabeçalho e a conexão com o banco de dados
include __DIR__ . '/../core/conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensagem'] = "Você precisa estar logado para acessar seus produtos.";
    $_SESSION['tipo_mensagem'] = "warning";
    header('Location: autenticacao.php?acao=login');
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];

// --- Novas consultas para o dashboard ---
// Total de produtos
$sql_total = "SELECT COUNT(*) AS total FROM produtos WHERE usuario_id = ?";
$stmt_total = $con->prepare($sql_total);
$stmt_total->bind_param("i", $usuario_id);
$stmt_total->execute();
$resultado_total = $stmt_total->get_result()->fetch_assoc();
$total_produtos = $resultado_total['total'];

// Produtos disponíveis
$sql_disponiveis = "SELECT COUNT(*) AS disponiveis FROM produtos WHERE usuario_id = ? AND status_reserva = 'disponivel'";
$stmt_disponiveis = $con->prepare($sql_disponiveis);
$stmt_disponiveis->bind_param("i", $usuario_id);
$stmt_disponiveis->execute();
$resultado_disponiveis = $stmt_disponiveis->get_result()->fetch_assoc();
$produtos_disponiveis = $resultado_disponiveis['disponiveis'];

// Produtos reservados
$sql_reservados = "SELECT COUNT(*) AS reservados FROM produtos WHERE usuario_id = ? AND status_reserva = 'reservado'";
$stmt_reservados = $con->prepare($sql_reservados);
$stmt_reservados->bind_param("i", $usuario_id);
$stmt_reservados->execute();
$resultado_reservados = $stmt_reservados->get_result()->fetch_assoc();
$produtos_reservados = $resultado_reservados['reservados'];

// Produtos vendidos
$sql_vendidos = "SELECT COUNT(*) AS vendidos FROM produtos WHERE usuario_id = ? AND status_reserva = 'vendido'";
$stmt_vendidos = $con->prepare($sql_vendidos);
$stmt_vendidos->bind_param("i", $usuario_id);
$stmt_vendidos->execute();
$resultado_vendidos = $stmt_vendidos->get_result()->fetch_assoc();
$produtos_vendidos = $resultado_vendidos['vendidos'];

// SQL para listar os produtos, agora incluindo os dados do comprador
$sql = "
    SELECT 
        p.id, p.nome, p.preco, p.imagem, p.status_reserva, p.comprador_id,
        u_vendedor.nome AS nome_reservador, u_vendedor.telefone AS telefone_reservador,
        u_comprador.nome AS nome_comprador, u_comprador.telefone AS telefone_comprador
    FROM 
        produtos p
    LEFT JOIN 
        usuarios u_vendedor ON p.usuario_id = u_vendedor.id
    LEFT JOIN 
        usuarios u_comprador ON p.comprador_id = u_comprador.id
    WHERE 
        p.usuario_id = ? 
    ORDER BY 
        p.data_cadastro DESC";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

include __DIR__ . '/../includes/header.php';


?>

