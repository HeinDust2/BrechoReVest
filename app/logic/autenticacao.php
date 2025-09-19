<?php
// O 'session_start()' deve ser a primeira coisa a ser executada na página,
// antes de qualquer HTML ou inclusão que possa gerar saída.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclui a conexão com o banco de dados.
include __DIR__ . '/../core/conexao.php';


// Limpa e obtém a ação da URL. Se não houver, a ação padrão é 'login'.
$acao = filter_input(INPUT_GET, 'acao', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'login';
$mensagem = '';
$tipo_mensagem = '';

// Se uma mensagem de sessão existir, a exibe e a remove.
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    $tipo_mensagem = $_SESSION['tipo_mensagem'];
    unset($_SESSION['mensagem']);
    unset($_SESSION['tipo_mensagem']);
}

// Lógica de Logout: deve ser a primeira verificação.
if ($acao === 'logout' && isset($_SESSION['usuario'])) {
    $_SESSION = array();
    session_destroy();
    // Redireciona para a página de login após o logout.
    header("Location: autenticacao.php?acao=login");
    exit();
}

// Se o usuário já estiver logado, redireciona para a página principal,
// a menos que a ação seja 'logout'.
if (isset($_SESSION['usuario'])) {
    $sql = "SELECT first_login FROM usuarios WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $_SESSION['usuario']['id']);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario_db = $resultado->fetch_assoc();

    if ($usuario_db && $usuario_db['first_login'] == 1) {
        header('Location: first_step.php');
        exit();
    }
    header('Location: index.php');
    exit();
}

// Lógica de processamento dos formulários (POST).
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($acao === 'login') {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = $_POST['senha'] ?? '';
        if ($email && $senha) {
            $sql = "SELECT id, nome, email, senha, first_login, foto_perfil FROM usuarios WHERE email = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $usuario = $resultado->fetch_assoc();
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nome' => $usuario['nome'],
                    'email' => $usuario['email'],
                    'foto_perfil' => $usuario['foto_perfil']
                ];
                if ($usuario['first_login'] == 1) {
                    header('Location: first_step.php');
                } else {
                    header('Location: index.php');
                }
                exit();
            } else {
                $mensagem = "Email ou senha incorretos.";
                $tipo_mensagem = "danger";
            }
        }
    } elseif ($acao === 'cadastro') {
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = $_POST['senha'] ?? '';
        $confirmar_senha = $_POST['confirmar_senha'] ?? '';
        $senha_seguranca = $_POST['senha_seguranca'] ?? '';

        if ($senha !== $confirmar_senha) {
            $mensagem = "As senhas não coincidem.";
            $tipo_mensagem = "danger";
        } elseif ($nome && $email && $senha && $senha_seguranca) {
            $sql_check = "SELECT id FROM usuarios WHERE email = ?";
            $stmt_check = $con->prepare($sql_check);
            $stmt_check->bind_param("s", $email);
            $stmt_check->execute();
            $resultado_check = $stmt_check->get_result();

            if ($resultado_check->num_rows > 0) {
                $mensagem = "Este email já está cadastrado. Por favor, use outro endereço.";
                $tipo_mensagem = "danger";
            } else {
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                $senha_seguranca_hash = password_hash($senha_seguranca, PASSWORD_DEFAULT);

                $sql = "INSERT INTO usuarios (nome, email, senha, senha_seguranca) VALUES (?, ?, ?, ?)";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ssss", $nome, $email, $senha_hash, $senha_seguranca_hash);

                if ($stmt->execute()) {
                    $novo_usuario_id = $stmt->insert_id;
                    $_SESSION['usuario'] = [
                        'id' => $novo_usuario_id,
                        'nome' => $nome,
                        'email' => $email,
                    ];
                    $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
                    $_SESSION['tipo_mensagem'] = "success";
                    
                    header('Location: first_step.php');
                    exit();
                } else {
                    $mensagem = "Erro ao cadastrar. O email pode já estar em uso.";
                    $tipo_mensagem = "danger";
                }
            }
        }
    } elseif ($acao === 'redefinir_senha') {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha_seguranca = $_POST['senha_seguranca'] ?? '';
        $nova_senha = $_POST['nova_senha'] ?? '';
        $confirmar_nova_senha = $_POST['confirmar_nova_senha'] ?? '';

        if ($nova_senha !== $confirmar_nova_senha) {
            $mensagem = "As novas senhas não coincidem.";
            $tipo_mensagem = "danger";
        } elseif ($email && $senha_seguranca && $nova_senha) {
            $sql = "SELECT id, senha_seguranca FROM usuarios WHERE email = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $usuario = $resultado->fetch_assoc();

            if ($usuario && password_verify($senha_seguranca, $usuario['senha_seguranca'])) {
                $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
                $sql_update = "UPDATE usuarios SET senha = ? WHERE id = ?";
                $stmt_update = $con->prepare($sql_update);
                $stmt_update->bind_param("si", $nova_senha_hash, $usuario['id']);

                if ($stmt_update->execute()) {
                    $_SESSION['mensagem'] = "Sua senha foi redefinida com sucesso! Agora você pode fazer login.";
                    $_SESSION['tipo_mensagem'] = "success";
                    header("Location: autenticacao.php?acao=login");
                    exit();
                } else {
                    $mensagem = "Ocorreu um erro ao redefinir a senha.";
                    $tipo_mensagem = "danger";
                }
            } else {
                $mensagem = "Email ou senha de segurança incorretos.";
                $tipo_mensagem = "danger";
            }
        }
    }
}

include __DIR__ . '/../includes/header.php'; 
?>

