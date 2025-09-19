<?php
// Inicia a sessão se ainda não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Configura o cabeçalho para retornar JSON
header('Content-Type: application/json');

// Conexão com o banco de dados
require_once __DIR__ . '/../core/conexao.php';

// Inicializa a resposta padrão
$response = ['status' => 'error', 'message' => 'Requisição inválida.'];

// Verifica se a requisição é do tipo POST e se os dados necessários foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_evento'])) {
    $id_evento = (int)$_POST['id_evento'];

    if ($id_evento > 0) {
        // Incrementa o contador do evento
        $stmt_update = $con->prepare("UPDATE eventos SET confirmacoes = confirmacoes + 1 WHERE id = ?");
        $stmt_update->bind_param("i", $id_evento);

        if ($stmt_update->execute()) {
            // Busca o novo valor do contador após o incremento
            $stmt_count = $con->prepare("SELECT confirmacoes FROM eventos WHERE id = ?");
            $stmt_count->bind_param("i", $id_evento);
            $stmt_count->execute();
            $stmt_count->bind_result($novo_total);
            $stmt_count->fetch();
            $stmt_count->close();

            $response['status'] = 'success';
            $response['total'] = $novo_total;
        } else {
            $response['message'] = 'Erro ao atualizar o banco de dados.';
        }
        $stmt_update->close();
    } else {
        $response['message'] = 'ID do evento inválido.';
    }
}

// Envia a resposta em formato JSON
echo json_encode($response);

// Fecha a conexão com o banco de dados
$con->close();
?>