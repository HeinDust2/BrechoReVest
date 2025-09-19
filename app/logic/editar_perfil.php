<?php
// Exibe erros para debug (remova em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inicia a sessão se ainda não estiver ativa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclui a conexão com o banco de dados
include __DIR__ . '/../core/conexao.php';

// Define caminho para uploads
$caminho_uploads = __DIR__ . '/../../public/uploads/';
if (!is_dir($caminho_uploads)) {
    mkdir($caminho_uploads, 0777, true);
}

// Redireciona se não logado
if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensagem'] = "Você precisa estar logado para editar seu perfil.";
    $_SESSION['tipo_mensagem'] = "warning";
    header('Location: autenticacao.php?acao=login');
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];

// Carrega dados atuais do usuário
$sql = "SELECT nome, nome_loja, email, telefone, whatsapp, instagram, facebook, tiktok, cep, rua, numero, complemento, bairro, cidade, estado, foto_perfil, senha FROM usuarios WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario_db = $resultado->fetch_assoc();

if (!$usuario_db) {
    $_SESSION['mensagem'] = "Usuário não encontrado. Faça login novamente.";
    $_SESSION['tipo_mensagem'] = "danger";
    header('Location: autenticacao.php?acao=logout');
    exit();
}

$caminho_foto = !empty($usuario_db['foto_perfil'])
    ? '../public/uploads/' . htmlspecialchars($usuario_db['foto_perfil'])
    : '../public/uploads/placeholder-profile.png';

// Processa formulários
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    // Atualizar perfil
    if ($acao === 'atualizar_perfil') {
        $campos = ['nome','nome_loja','telefone','whatsapp','instagram','facebook','tiktok','cep','rua','numero','complemento','bairro','cidade','estado'];
        $valores = [];
        foreach($campos as $campo){
            $valores[$campo] = filter_input(INPUT_POST, $campo, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        // Campos obrigatórios
        $obrigatorios = ['nome','nome_loja','telefone','cep','rua','numero','bairro','cidade','estado'];
        foreach($obrigatorios as $campo){
            if(empty($valores[$campo])){
                $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios.";
                $_SESSION['tipo_mensagem'] = "danger";
                header('Location: editar_perfil.php');
                exit();
            }
        }

        $sql = "UPDATE usuarios SET nome=?, nome_loja=?, telefone=?, whatsapp=?, instagram=?, facebook=?, tiktok=?, cep=?, rua=?, numero=?, complemento=?, bairro=?, cidade=?, estado=? WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param(
            "ssssssssssssssi",
            $valores['nome'],$valores['nome_loja'],$valores['telefone'],$valores['whatsapp'],
            $valores['instagram'],$valores['facebook'],$valores['tiktok'],$valores['cep'],
            $valores['rua'],$valores['numero'],$valores['complemento'],$valores['bairro'],
            $valores['cidade'],$valores['estado'],$usuario_id
        );
        if($stmt->execute()){
            $_SESSION['mensagem'] = "Perfil atualizado com sucesso!";
            $_SESSION['tipo_mensagem'] = "success";
            $_SESSION['usuario']['nome'] = $valores['nome'];
        } else {
            $_SESSION['mensagem'] = "Erro ao atualizar perfil.";
            $_SESSION['tipo_mensagem'] = "danger";
        }
        header('Location: editar_perfil.php');
        exit();
    }

    // Atualizar foto
    if ($acao === 'atualizar_foto') {
        if(isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK){
            $tmp = $_FILES['foto_perfil']['tmp_name'];
            $ext = strtolower(pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION));
            $valid = ['jpg','jpeg','png','gif'];
            if(in_array($ext,$valid)){
                $novo_nome = uniqid('foto_',true).".".$ext;
                $destino = $caminho_uploads . $novo_nome;
                if(move_uploaded_file($tmp,$destino)){
                    if(!empty($usuario_db['foto_perfil'])){
                        $antiga = $caminho_uploads . $usuario_db['foto_perfil'];
                        if(file_exists($antiga)) unlink($antiga);
                    }
                    $sql = "UPDATE usuarios SET foto_perfil=? WHERE id=?";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("si",$novo_nome,$usuario_id);
                    $stmt->execute();
                    $_SESSION['usuario']['foto_perfil'] = $novo_nome;
                    $_SESSION['mensagem'] = "Foto atualizada!";
                    $_SESSION['tipo_mensagem'] = "success";
                } else {
                    $_SESSION['mensagem'] = "Erro ao mover o arquivo.";
                    $_SESSION['tipo_mensagem'] = "danger";
                }
            } else {
                $_SESSION['mensagem'] = "Formato inválido (JPG, PNG, GIF).";
                $_SESSION['tipo_mensagem'] = "danger";
            }
        } else {
            $_SESSION['mensagem'] = "Erro no upload da imagem.";
            $_SESSION['tipo_mensagem'] = "danger";
        }
        header('Location: editar_perfil.php');
        exit();
    }

    // Remover foto
    if ($acao === 'remover_foto'){
        if(!empty($usuario_db['foto_perfil'])){
            $antiga = $caminho_uploads . $usuario_db['foto_perfil'];
            if(file_exists($antiga)) unlink($antiga);
        }
        $stmt = $con->prepare("UPDATE usuarios SET foto_perfil=NULL WHERE id=?");
        $stmt->bind_param("i",$usuario_id);
        $stmt->execute();
        unset($_SESSION['usuario']['foto_perfil']);
        $_SESSION['mensagem'] = "Foto removida!";
        $_SESSION['tipo_mensagem'] = "success";
        header('Location: editar_perfil.php');
        exit();
    }

    // Mudar senha
    if($acao === 'mudar_senha'){
        $senha_atual = $_POST['senha_atual'] ?? '';
        $nova = $_POST['nova_senha'] ?? '';
        $confirma = $_POST['confirma_senha'] ?? '';

        if(password_verify($senha_atual,$usuario_db['senha'])){
            if($nova === $confirma){
                if(strlen($nova) >= 8){
                    $hash = password_hash($nova,PASSWORD_DEFAULT);
                    $stmt = $con->prepare("UPDATE usuarios SET senha=? WHERE id=?");
                    $stmt->bind_param("si",$hash,$usuario_id);
                    $stmt->execute();
                    $_SESSION['mensagem'] = "Senha alterada!";
                    $_SESSION['tipo_mensagem'] = "success";
                } else {
                    $_SESSION['mensagem'] = "Nova senha deve ter no mínimo 8 caracteres.";
                    $_SESSION['tipo_mensagem'] = "danger";
                }
            } else {
                $_SESSION['mensagem'] = "Nova senha e confirmação não coincidem.";
                $_SESSION['tipo_mensagem'] = "danger";
            }
        } else {
            $_SESSION['mensagem'] = "Senha atual incorreta.";
            $_SESSION['tipo_mensagem'] = "danger";
        }
        header('Location: editar_perfil.php');
        exit();
    }
}

include __DIR__ . '/../includes/header.php'; 
?>

