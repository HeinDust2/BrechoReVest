<?php
// Inicia a sessão se ainda não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o ID do usuário está na sessão.
$id_usuario = $_SESSION['usuario']['id'] ?? null; 

if ($id_usuario === null) {
    die("Você precisa estar logado para ver este relatório.");
}

// Inclui o arquivo de conexão. A variável de conexão é $con
include_once __DIR__ . '/../core/conexao.php';
include_once __DIR__ . '/../includes/header.php';

// --- CONSULTAS SQL PARA O DASHBOARD ---

// 1. Obter as contagens de produtos usando a VIEW
$sql_contadores = "SELECT * FROM relatorio_vendas_por_usuario WHERE usuario_id = ?";
$stmt_contadores = $con->prepare($sql_contadores);
$stmt_contadores->bind_param("i", $id_usuario);
$stmt_contadores->execute();
$result_contadores = $stmt_contadores->get_result();
$row_contadores = $result_contadores->fetch_assoc();

// Atribui os valores (usando '?? 0' para evitar erros se não houver dados)
$total_produtos = $row_contadores['total_produtos'] ?? 0;
$produtos_disponiveis = $row_contadores['total_disponiveis'] ?? 0;
$produtos_reservados = $row_contadores['total_reservados'] ?? 0;
$produtos_vendidos = $row_contadores['total_vendidos'] ?? 0;

$stmt_contadores->close();

// 2. Buscar os 5 últimos produtos reservados do usuário logado (o vendedor)
$sql_reservados = "SELECT 
    p.nome AS produto_nome, 
    p.imagem,
    p.id,
    p.data_cadastro,
    u.nome AS comprador_nome
FROM 
    produtos p
JOIN
    usuarios u ON p.comprador_id = u.id
WHERE 
    p.usuario_id = ? AND p.status_reserva = 'reservado'
ORDER BY 
    p.data_cadastro DESC
LIMIT 5";

$stmt_reservados = $con->prepare($sql_reservados);
$stmt_reservados->bind_param("i", $id_usuario);
$stmt_reservados->execute();
$produtos_reservados_recentes = $stmt_reservados->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt_reservados->close();

// 3. Buscar as 5 últimas vendas do usuário logado (o vendedor)
$sql_vendas = "SELECT 
    v.data_venda, 
    p.nome AS produto_nome, 
    p.imagem,
    p.id,
    u.nome AS comprador_nome
FROM 
    vendas v
JOIN 
    produtos p ON v.produto_id = p.id
JOIN 
    usuarios u ON v.comprador_id = u.id
WHERE 
    v.usuario_id = ?
ORDER BY 
    v.data_venda DESC
LIMIT 5";

$stmt_vendas = $con->prepare($sql_vendas);
$stmt_vendas->bind_param("i", $id_usuario);
$stmt_vendas->execute();
$vendas_recentes = $stmt_vendas->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt_vendas->close();


// Fechar a conexão
$con->close();
?>

