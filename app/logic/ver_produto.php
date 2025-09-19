<?php
// Lógica para a página ver_produto.php

// Inicia a sessão se ainda não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . '/../core/conexao.php';


// Sanitiza e valida o ID do produto
$id_produto = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$produto = null;
if ($id_produto) {
    // Consulta SQL corrigida com os nomes de colunas da sua tabela
    $sql = "SELECT p.id, p.nome, p.descricao, p.preco, p.imagem, p.status_reserva, p.usuario_id,
                p.tamanho, p.tipo_roupa, p.estilo, p.cor, p.materiais, p.data_cadastro,
                p.pagamento,
                u.nome AS vendedor, u.bairro AS bairro_loja
        FROM produtos p
        JOIN usuarios u ON p.usuario_id = u.id
        WHERE p.id = ?";


    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id_produto);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Atribui os resultados da consulta à variável $produto
        $produto = $resultado->fetch_assoc();
    }
}

include __DIR__ . '/../includes/header.php';


?>
