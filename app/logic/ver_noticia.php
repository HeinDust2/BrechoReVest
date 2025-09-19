<?php
// ver_noticia.php

// Inicia a sessão se ainda não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexão com o banco de dados
require_once __DIR__ . '/../core/conexao.php';

// ==================== TRATAMENTO DO POST (incrementar contador) ====================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_evento'])) {
    header('Content-Type: application/json; charset=utf-8');

    $id_evento = (int) $_POST['id_evento'];
    if ($id_evento <= 0) {
        echo json_encode(['success' => false, 'error' => 'ID inválido']);
        exit;
    }

    // Incrementa (garantindo que NULL vire 0)
    $sql = "UPDATE eventos SET confirmacoes = COALESCE(confirmacoes, 0) + 1 WHERE id = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i", $id_evento);
        $executed = $stmt->execute();
        $stmt->close();

        if ($executed) {
            $sql2 = "SELECT confirmacoes FROM eventos WHERE id = ?";
            if ($stmt2 = $con->prepare($sql2)) {
                $stmt2->bind_param("i", $id_evento);
                $stmt2->execute();
                $res = $stmt2->get_result();
                $row = $res->fetch_assoc();
                $stmt2->close();

                $confirmacoes = isset($row['confirmacoes']) ? (int)$row['confirmacoes'] : 0;
                echo json_encode(['success' => true, 'confirmacoes' => $confirmacoes]);
                exit;
            }
        }
    }

    // Se chegou aqui, algo falhou
    echo json_encode(['success' => false]);
    exit;
}
// ==============================================================================


// ==================== CÁLCULO DO CONTEÚDO (GET) ====================
$titulo_pagina = "Conteúdo Não Encontrado";
$conteudo = null;
$tipo_conteudo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
$id_conteudo = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$imagem_caminho = '';

if ($id_conteudo > 0) {
    $sql = '';
    switch ($tipo_conteudo) {
        case 'noticia':
            $sql = "SELECT * FROM noticias WHERE id = ?";
            break;
        case 'evento':
            $sql = "SELECT * FROM eventos WHERE id = ?";
            break;
    }

    if ($sql) {
        if ($stmt = $con->prepare($sql)) {
            $stmt->bind_param("i", $id_conteudo);
            $stmt->execute();
            $resultado = $stmt->get_result();
            if ($resultado && $resultado->num_rows > 0) {
                $conteudo = $resultado->fetch_assoc();
            }
            $stmt->close();
        }
    }
}

if ($conteudo) {
    if ($tipo_conteudo === 'noticia') {
        $titulo_pagina = htmlspecialchars($conteudo['resumo']);
        $imagem_caminho = 'uploads/' . htmlspecialchars($conteudo['imagem']);
    } elseif ($tipo_conteudo === 'evento') {
        $titulo_pagina = htmlspecialchars($conteudo['nome_evento']);
        $imagem_caminho = 'uploads/' . htmlspecialchars($conteudo['imagem_evento']);
    }
}
// ==============================================================================

include __DIR__ . '/../includes/header.php';
?>
