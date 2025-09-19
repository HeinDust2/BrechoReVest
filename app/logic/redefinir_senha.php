<?php
// Inclui a conexão com o banco de dados.
include __DIR__ . '/../core/conexao.php';
// Inicia a sessão se ainda não estiver iniciada.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$mensagem = '';
$tipo_mensagem = '';
$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

// Verifica se o token está presente na URL.
if (empty($token)) {
    $mensagem = "Token de redefinição de senha não fornecido.";
    $tipo_mensagem = "danger";
    $token_valido = false;
} else {
    // Verifica se o token é válido e ainda não expirou.
    $sql = "SELECT id FROM usuarios WHERE reset_token = ? AND reset_token_exp > NOW()";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    if (!$usuario) {
        $mensagem = "O link de redefinição é inválido ou expirou. Por favor, solicite um novo.";
        $tipo_mensagem = "danger";
        $token_valido = false;
    } else {
        $token_valido = true;
    }
}

// Lógica de processamento do formulário de redefinição de senha.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $token_valido) {
    $nova_senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    if ($nova_senha !== $confirmar_senha) {
        $mensagem = "As senhas não coincidem.";
        $tipo_mensagem = "danger";
    } else {
        // Atualiza a senha e limpa o token.
        $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
        $sql_update = "UPDATE usuarios SET senha = ?, reset_token = NULL, reset_token_exp = NULL WHERE id = ?";
        $stmt_update = $con->prepare($sql_update);
        $stmt_update->bind_param("si", $senha_hash, $usuario['id']);

        if ($stmt_update->execute()) {
            $_SESSION['mensagem'] = "Sua senha foi redefinida com sucesso! Faça login com a nova senha.";
            $_SESSION['tipo_mensagem'] = "success";
            header("Location: autenticacao.php?acao=login");
            exit();
        } else {
            $mensagem = "Ocorreu um erro ao redefinir a senha.";
            $tipo_mensagem = "danger";
        }
    }
}

include __DIR__ . '/../includes/header.php';
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <?php if (!empty($mensagem)): ?>
                <div class="alert alert-<?= htmlspecialchars($tipo_mensagem) ?> alert-dismissible fade show rounded-4" role="alert">
                    <?= htmlspecialchars($mensagem) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if ($token_valido): ?>
                <div class="card rounded-4 card-hover-effect">
                    <div class="card-header text-center" style="background-color: #5AA4FA;">
                        <h3 class="my-2 text-light"><i class="bi bi-key me-2"></i> Redefinir Senha</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="redefinir_senha.php?token=<?= htmlspecialchars($token) ?>" method="POST">
                            <div class="mb-3">
                                <label for="nova_senha" class="form-label">Nova Senha</label>
                                <input type="password" class="form-control rounded-pill" id="nova_senha" name="senha" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmar_nova_senha" class="form-label">Confirmar Nova Senha</label>
                                <input type="password" class="form-control rounded-pill" id="confirmar_nova_senha" name="confirmar_senha" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100 rounded-pill"><i class="bi bi-check-circle me-2"></i> Redefinir Senha</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="autenticacao.php?acao=login">Voltar para o Login</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>