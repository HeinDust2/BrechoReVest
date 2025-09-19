<!-- listar_produtos.php logic -->
<?php
// Inicia a sessão
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexão com o banco
require_once __DIR__ . '/../core/conexao.php';

// Coleta parâmetro de busca
$busca = $_GET['busca'] ?? '';

// Consulta SQL
// Consulta SQL buscando bairro direto na tabela produtos
$sql = "SELECT  
        p.id, 
        p.nome, 
        p.preco, 
        p.imagem, 
        p.descricao, 
        u.id AS usuario_id,
        u.nome AS vendedor, 
        u.bairro AS bairro_loja
    FROM produtos p
    JOIN usuarios u ON p.usuario_id = u.id
    WHERE p.status_reserva = 'disponivel'";

$params = [];
$types = '';

if (!empty($busca)) {
    $sql .= " AND (p.nome LIKE ? OR p.descricao LIKE ?)";
    $params = ["%$busca%", "%$busca%"];
    $types = 'ss';
}

$sql .= " ORDER BY p.data_cadastro DESC";

$stmt = $con->prepare($sql);
if ($stmt === false) die("Erro na preparação da consulta: " . $con->error);

if (!empty($busca)) $stmt->bind_param($types, ...$params);

$stmt->execute();
$resultado = $stmt->get_result();

