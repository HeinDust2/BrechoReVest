<?php
// Inicia a sessão se ainda não estiver ativa.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclui a conexão com o banco de dados.
require_once __DIR__ . '/../core/conexao.php';
require_once __DIR__ . '/../includes/header.php';

// Obtém o ID da loja da URL.
$usuario_id = $_GET['id'] ?? null;

if (!$usuario_id) {
    // Redireciona ou exibe erro se o ID da loja não for fornecido.
    header('Location: listar_produtos.php?msg=loja_nao_encontrada');
    exit();
}

// Prepara e executa a query para buscar os dados completos da loja.
$sql = "SELECT id, nome, email, telefone, foto_perfil, cep, rua, numero, complemento, bairro, cidade, estado, facebook, instagram, twitter, tiktok, whatsapp
        FROM usuarios
        WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
$loja = $resultado->fetch_assoc();

if (!$loja) {
    // Loja não encontrada.
    header('Location: listar_produtos.php?msg=loja_nao_encontrada');
    exit();
}

// O caminho foi corrigido para usar "../public/uploads/".
$caminho_foto = !empty($loja['foto_perfil'])
    ? '../public/uploads/' . htmlspecialchars($loja['foto_perfil'])
    : '../public/uploads/placeholder-profile.png';

// Prepara o número de telefone da loja para o link do WhatsApp.
$telefone_whatsapp_loja = preg_replace('/[^0-9]/', '', $loja['telefone'] ?? '');
if (!empty($telefone_whatsapp_loja) && strlen($telefone_whatsapp_loja) == 11 && substr($telefone_whatsapp_loja, 0, 2) != '55') {
    $telefone_whatsapp_loja = '55' . $telefone_whatsapp_loja;
} elseif (strlen($telefone_whatsapp_loja) == 10 && substr($telefone_whatsapp_loja, 0, 2) != '55') {
    $telefone_whatsapp_loja = '55' . $telefone_whatsapp_loja;
}
$stmt->close();
$con->close();

?>