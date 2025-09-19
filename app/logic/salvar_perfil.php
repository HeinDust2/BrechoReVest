<?php
// Inicia a sessão se ainda não estiver ativa.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . '/../core/conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['id'];

    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'] ?? null;
    $facebook = $_POST['facebook'] ?? null;
    $instagram = $_POST['instagram'] ?? null;
    $twitter = $_POST['twitter'] ?? null;
    $cep = $_POST['cep'] ?? null;
    $rua = $_POST['rua'] ?? null;
    $numero = $_POST['numero'] ?? null;
    $complemento = $_POST['complemento'] ?? null;
    $bairro = $_POST['bairro'] ?? null;
    $cidade = $_POST['cidade'] ?? null;
    $estado = $_POST['estado'] ?? null;

    $foto_perfil = null;
    $upload_dir = 'uploads/perfil/';

    // Lida com o upload da foto de perfil
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == UPLOAD_ERR_OK) {
        $file_name = uniqid() . '_' . basename($_FILES['foto_perfil']['name']);
        $target_file = $upload_dir . $file_name;

        // Cria o diretório se não existir
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $target_file)) {
            $foto_perfil = $target_file;
        } else {
            // Se o upload falhar, podemos ignorar ou exibir um erro
            // Por enquanto, vamos apenas ignorar e manter a foto anterior
            $foto_perfil = null;
        }
    }

    // Prepara a consulta SQL para atualizar o perfil
    // NÃO INCLUI MAIS A SENHA
    $sql_update = "UPDATE usuarios SET nome = ?, email = ?, telefone = ?, facebook = ?, instagram = ?, twitter = ?, cep = ?, rua = ?, numero = ?, complemento = ?, bairro = ?, cidade = ?, estado = ?";
    $params = [$nome, $email, $telefone, $facebook, $instagram, $twitter, $cep, $rua, $numero, $complemento, $bairro, $cidade, $estado];
    $types = "sssssssssssss";

    if ($foto_perfil) {
        $sql_update .= ", foto_perfil = ?";
        $params[] = $foto_perfil;
        $types .= "s";
    }

    $sql_update .= " WHERE id = ?";
    $params[] = $user_id;
    $types .= "i";

    $stmt_update = $con->prepare($sql_update);

    if ($stmt_update === false) {
        die("Erro na preparação da consulta: " . $con->error);
    }

    $stmt_update->bind_param($types, ...$params);

    if ($stmt_update->execute()) {
        // Atualiza a sessão com os novos dados
        $_SESSION['usuario']['nome'] = $nome;
        header("Location: editar_perfil.php?msg=perfil_atualizado");
    } else {
        header("Location: editar_perfil.php?msg=erro_atualizacao");
    }

    $stmt_update->close();
} else {
    // Redireciona se a requisição não for um POST
    header("Location: editar_perfil.php");
}

$con->close();
?>