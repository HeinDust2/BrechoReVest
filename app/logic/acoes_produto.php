<?php
// Inicia a sessão se ainda não estiver ativa.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclui a conexão com o banco de dados
include __DIR__ . '/../core/conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id'])) {
    $_SESSION['mensagem'] = "Você precisa estar logado para realizar esta ação.";
    $_SESSION['tipo_mensagem'] = "danger";
    header('Location: autenticacao.php?acao=login');
    exit();
}

// Usamos filter_input para pegar os dados do POST e do GET de forma segura.
$produto_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);
$acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_SPECIAL_CHARS) ?? filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_SPECIAL_CHARS);

if (!$produto_id || !$acao) {
    $_SESSION['mensagem'] = "Ação inválida.";
    $_SESSION['tipo_mensagem'] = "danger";
    header('Location: index.php');
    exit();
}

// O ID do usuário logado agora é consistente em todo o código
$usuario_logado_id = $_SESSION['usuario']['id'];
$redirecionar_para = 'index.php';

switch ($acao) {
    case 'reservar':
        // Ação de reservar - garante que o produto não é do próprio usuário
        $sql = "UPDATE produtos SET status_reserva = 'reservado', comprador_id = ? WHERE id = ? AND status_reserva = 'disponivel' AND usuario_id != ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("iii", $usuario_logado_id, $produto_id, $usuario_logado_id);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['mensagem'] = "Produto reservado com sucesso!";
                $_SESSION['tipo_mensagem'] = "success";
            } else {
                $_SESSION['mensagem'] = "Erro ao reservar. O produto pode já estar reservado ou pertencer a você.";
                $_SESSION['tipo_mensagem'] = "warning";
            }
        } else {
            $_SESSION['mensagem'] = "Erro ao reservar produto.";
            $_SESSION['tipo_mensagem'] = "danger";
        }
        $redirecionar_para = 'ver_produto.php?id=' . $produto_id;
        break;

    case 'cancelar_reserva':
        // Ação de cancelar reserva - verifica se o usuário logado é o comprador
        $sql = "UPDATE produtos SET status_reserva = 'disponivel', comprador_id = NULL WHERE id = ? AND comprador_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ii", $produto_id, $usuario_logado_id);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['mensagem'] = "Reserva cancelada com sucesso.";
                $_SESSION['tipo_mensagem'] = "success";
            } else {
                $_SESSION['mensagem'] = "Não foi possível cancelar a reserva. Contate o comprador ou espere o tempo de maximo de reserva acabar.";
                $_SESSION['tipo_mensagem'] = "warning";
            }
        } else {
            $_SESSION['mensagem'] = "Erro ao cancelar reserva.";
            $_SESSION['tipo_mensagem'] = "danger";
        }

        $redirecionar_para = 'minhas_reservas.php?id=' . $produto_id;
        break;

    case 'vender':
        // Ação de marcar como vendido - a transação agora é segura
        $con->begin_transaction();
        try {
            // 1. Verifica se o produto está reservado E pertence ao vendedor logado
            $sql_check = "SELECT status_reserva, comprador_id, usuario_id FROM produtos WHERE id = ? AND usuario_id = ?";
            $stmt_check = $con->prepare($sql_check);
            $stmt_check->bind_param("ii", $produto_id, $usuario_logado_id);
            $stmt_check->execute();
            $resultado_check = $stmt_check->get_result();

            if ($resultado_check->num_rows > 0) {
                $produto_info = $resultado_check->fetch_assoc();
                $status_reserva = $produto_info['status_reserva'];
                $comprador_do_produto = $produto_info['comprador_id'];

                // 2. Garante que o produto está reservado e que existe um comprador
                if ($status_reserva === 'reservado' && $comprador_do_produto !== NULL) {
                    // 3. Atualiza o status do produto para 'vendido'
                    $sql_update_produto = "UPDATE produtos SET status_reserva = 'vendido' WHERE id = ?";
                    $stmt_update_produto = $con->prepare($sql_update_produto);
                    $stmt_update_produto->bind_param("i", $produto_id);
                    $stmt_update_produto->execute();

                    // 4. Insere o registro de venda na tabela 'vendas'
                    $sql_insert_venda = "INSERT INTO vendas (produto_id, comprador_id, usuario_id) VALUES (?, ?, ?)";
                    $stmt_insert_venda = $con->prepare($sql_insert_venda);
                    $stmt_insert_venda->bind_param("iii", $produto_id, $comprador_do_produto, $usuario_logado_id);
                    $stmt_insert_venda->execute();
                    
                    // Se tudo der certo, confirma a transação
                    $con->commit();
                    $_SESSION['mensagem'] = "Produto marcado como vendido com sucesso!";
                    $_SESSION['tipo_mensagem'] = "success";
                } else {
                    $_SESSION['mensagem'] = "O produto não pode ser marcado como vendido (não está reservado ou não tem um comprador).";
                    $_SESSION['tipo_mensagem'] = "warning";
                }
            } else {
                $_SESSION['mensagem'] = "Produto não encontrado ou você não tem permissão.";
                $_SESSION['tipo_mensagem'] = "danger";
            }
        } catch (mysqli_sql_exception $e) {
            // Em caso de erro, desfaz a transação
            $con->rollback();
            $_SESSION['mensagem'] = "Erro ao marcar o produto como vendido: " . $e->getMessage();
            $_SESSION['tipo_mensagem'] = "danger";
        }
        $redirecionar_para = 'meus_produtos.php';
        break;

    case 'excluir':
        // Ação de exclusão
        $sql = "DELETE FROM produtos WHERE id = ? AND usuario_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ii", $produto_id, $usuario_logado_id);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['mensagem'] = "Produto excluído com sucesso.";
                $_SESSION['tipo_mensagem'] = "success";
            } else {
                 $_SESSION['mensagem'] = "Erro ao excluir produto. Ele pode não existir ou não pertencer a você.";
                 $_SESSION['tipo_mensagem'] = "warning";
            }
        } else {
            $_SESSION['mensagem'] = "Erro ao excluir produto.";
            $_SESSION['tipo_mensagem'] = "danger";
        }
        $redirecionar_para = 'meus_produtos.php';
        break;

    default:
        $_SESSION['mensagem'] = "Ação inválida.";
        $_SESSION['tipo_mensagem'] = "danger";
        break;
}

// Redireciona o usuário para a página apropriada
header('Location: ' . $redirecionar_para);
exit();
?>