<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../core/conexao.php';

// Redireciona se o usuário não estiver logado ou já tiver completado o first-step
if (!isset($_SESSION['usuario'])) {
    header('Location: autenticacao.php?acao=login');
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];

// Verifica se a coluna first_login já é 0
$sql = "SELECT first_login FROM usuarios WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario_db = $resultado->fetch_assoc();

if ($usuario_db && $usuario_db['first_login'] == 0) {
    header('Location: index.php');
    exit();
}

$mensagem_sucesso = '';
$mensagem_erro = '';

// Lógica para a ação "Pular"
$acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_SPECIAL_CHARS);
if ($acao === 'pular') {
    $sql = "UPDATE usuarios SET first_login = 0 WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    
    $_SESSION['mensagem'] = "Bem-vindo(a) ao Brechó Revest!";
    $_SESSION['tipo_mensagem'] = "success";
    header('Location: index.php');
    exit();
}

// Lógica para processar o formulário de atualização (ocorre apenas após a segunda tela)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $acao === 'configurar') {
    $nome_loja = filter_input(INPUT_POST, 'nome_loja', FILTER_SANITIZE_SPECIAL_CHARS);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
    $whatsapp = filter_input(INPUT_POST, 'whatsapp', FILTER_SANITIZE_SPECIAL_CHARS);
    $instagram = filter_input(INPUT_POST, 'instagram', FILTER_SANITIZE_SPECIAL_CHARS);
    $facebook = filter_input(INPUT_POST, 'facebook', FILTER_SANITIZE_SPECIAL_CHARS);
    $tiktok = filter_input(INPUT_POST, 'tiktok', FILTER_SANITIZE_SPECIAL_CHARS);
    $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS);
    $rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_SPECIAL_CHARS);
    $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS);
    $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_SPECIAL_CHARS);
    $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS);
    $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($nome_loja) || empty($telefone)) {
        $mensagem_erro = "Nome da loja e telefone são obrigatórios.";
    } else {
        $sql = "UPDATE usuarios SET nome_loja = ?, telefone = ?, whatsapp = ?, instagram = ?, facebook = ?, tiktok = ?, cep = ?, rua = ?, numero = ?, complemento = ?, bairro = ?, cidade = ?, estado = ?, first_login = 0 WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssssssssssi", $nome_loja, $telefone, $whatsapp, $instagram, $facebook, $tiktok, $cep, $rua, $numero, $complemento, $bairro, $cidade, $estado, $usuario_id);

        if ($stmt->execute()) {
            $_SESSION['mensagem'] = "Perfil configurado com sucesso!";
            $_SESSION['tipo_mensagem'] = "success";
            header('Location: index.php');
            exit();
        } else {
            $mensagem_erro = "Erro ao salvar as informações.";
        }
    }
}

include __DIR__ . '/../includes/header.php';


?>

