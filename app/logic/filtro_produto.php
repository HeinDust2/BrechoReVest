<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../core/conexao.php';

// Coleta e sanitiza os parâmetros de busca do formulário via GET
$busca_nome = $_GET['busca_nome'] ?? '';
$tamanho = $_GET['tamanho'] ?? '';
$cor = $_GET['cor'] ?? ''; // novo filtro
$bairro = $_GET['bairro'] ?? '';
$loja = $_GET['loja'] ?? '';
$materiais_raw = $_GET['materiais'] ?? '';
$preco_ordem = $_GET['preco_ordem'] ?? '';

// Variáveis para o filtro de preço
$preco_min = isset($_GET['preco_min']) && is_numeric($_GET['preco_min']) ? (float)$_GET['preco_min'] : null;
$preco_max = isset($_GET['preco_max']) && is_numeric($_GET['preco_max']) ? (float)$_GET['preco_max'] : null;

// Monta a consulta SQL base.
$sql = "SELECT
            p.id,
            p.nome,
            p.preco,
            p.imagem,
            p.materiais,
            p.descricao,
            u.id AS usuario_id,
            u.nome AS vendedor,
            u.bairro AS bairro_loja
        FROM produtos p
        JOIN usuarios u ON p.usuario_id = u.id
        WHERE p.status_reserva = 'disponivel'";

$params = [];
$types = '';

// Adiciona os filtros à consulta SQL, se eles existirem
if (!empty($busca_nome)) {
    $sql .= " AND (p.nome LIKE ? OR p.descricao LIKE ?)";
    $params[] = "%$busca_nome%";
    $params[] = "%$busca_nome%";
    $types .= 'ss';
}

if (!empty($tamanho)) {
    $sql .= " AND p.tamanho = ?";
    $params[] = $tamanho;
    $types .= 's';
}

if (!empty($cor)) {
    $sql .= " AND p.cor = ?";
    $params[] = $cor;
    $types .= 's';
}

if (!empty($bairro)) {
    $sql .= " AND u.bairro LIKE ?";
    $params[] = "%$bairro%";
    $types .= 's';
}

if (!empty($loja)) {
    $sql .= " AND u.nome LIKE ?";
    $params[] = "%$loja%";
    $types .= 's';
}

// Lógica para o filtro de materiais
if (!empty($materiais_raw)) {
    $materiais_cleaned = preg_replace('/[, ]+/', ' ', trim($materiais_raw));
    $materiais_array = explode(' ', $materiais_cleaned);
    $materiais_conditions = [];
    foreach ($materiais_array as $material) {
        if (!empty($material)) {
            $materiais_conditions[] = "p.materiais LIKE ?";
            $params[] = "%$material%";
            $types .= 's';
        }
    }
    if (!empty($materiais_conditions)) {
        $sql .= " AND (" . implode(' OR ', $materiais_conditions) . ")";
    }
}

// Adiciona a condição de filtro de intervalo de preços
if ($preco_min !== null) {
    $sql .= " AND p.preco >= ?";
    $params[] = $preco_min;
    $types .= 'd'; // 'd' para double/float
}
if ($preco_max !== null) {
    $sql .= " AND p.preco <= ?";
    $params[] = $preco_max;
    $types .= 'd'; // 'd' para double/float
}

// Adiciona a ordenação por preço, se especificada
if ($preco_ordem === 'asc') {
    $sql .= " ORDER BY p.preco ASC";
} elseif ($preco_ordem === 'desc') {
    $sql .= " ORDER BY p.preco DESC";
} else {
    $sql .= " ORDER BY p.data_cadastro DESC";
}

// Prepara e executa a consulta
$stmt = $con->prepare($sql);
if ($stmt === false) {
    die("Erro na preparação da consulta: " . $con->error);
}

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$resultado = $stmt->get_result();

// Verifica se algum filtro foi aplicado para manter a seção expandida
$filtros_ativos = !empty($busca_nome) || !empty($tamanho) || !empty($cor) || !empty($bairro) || !empty($loja) || !empty($materiais_raw) || !empty($preco_ordem) || ($preco_min !== null) || ($preco_max !== null);
?>

