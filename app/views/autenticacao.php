
<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <?php if (!empty($mensagem)): ?>
                <div class="alert alert-<?= htmlspecialchars($tipo_mensagem) ?> alert-dismissible fade show rounded-4" role="alert">
                    <?= htmlspecialchars($mensagem) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if ($acao === 'cadastro'): ?>
                <div class="card rounded-4 card-hover-effect">
                    <div class="card-header text-center" style="background-color: #5AA4FA;">
                        <h3 class="my-2 text-light"><i class="bi bi-person-plus me-2"></i> Cadastro</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="autenticacao.php?acao=cadastro" method="POST">
                            <div class="mb-3">
                                <label for="nome" class="form-label">
                                    Nome Completo
                                    <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Seu nome completo, como consta em seus documentos."></i>
                                </label>
                                <input type="text" class="form-control rounded-pill" id="nome" name="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="email_cadastro" class="form-label">
                                    Email
                                    <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="O endereço de email será seu nome de usuário para o login."></i>
                                </label>
                                <input type="email" class="form-control rounded-pill" id="email_cadastro" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha_cadastro" class="form-label">
                                    Senha
                                    <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Crie uma senha forte com no mínimo 8 caracteres, incluindo letras, números e símbolos."></i>
                                </label>
                                <input type="password" class="form-control rounded-pill" id="senha_cadastro" name="senha" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmar_senha" class="form-label">
                                    Confirmar Senha
                                    <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Digite a mesma senha novamente para confirmar."></i>
                                </label>
                                <input type="password" class="form-control rounded-pill" id="confirmar_senha" name="confirmar_senha" required>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="senha_seguranca" class="form-label">
                                    Senha de Segurança
                                    <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Esta senha é a única forma de recuperar sua conta caso esqueça a senha principal. É uma medida de segurança extra."></i>
                                </label>
                                <input type="password" class="form-control rounded-pill" id="senha_seguranca" name="senha_seguranca" required>
                                <div class="form-text">Usada para recuperar sua senha. Guarde-a em um local seguro.</div>
                            </div>
                            <button type="submit" class="btn btn-success w-100 rounded-pill"><i class="bi bi-person-plus-fill me-2"></i> Cadastrar</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        Já tem uma conta? <a href="autenticacao.php?acao=login">Faça login</a>
                    </div>
                </div>
            <?php elseif ($acao === 'esqueci_senha'): ?>
                <div class="card rounded-4 card-hover-effect">
                    <div class="card-header text-center" style="background-color: #5AA4FA;">
                        <h3 class="my-2 text-light"><i class="bi bi-key me-2"></i> Redefinir Senha</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="autenticacao.php?acao=redefinir_senha" method="POST">
                            <p class="text-center">Por favor, digite seu e-mail e sua senha de segurança.</p>
                            <div class="mb-3">
                                <label for="email_reset" class="form-label">
                                    Email
                                    <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="O endereço de email cadastrado na sua conta."></i>
                                </label>
                                <input type="email" class="form-control rounded-pill" id="email_reset" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha_seguranca_reset" class="form-label">
                                    Senha de Segurança
                                    <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="A senha de segurança que você criou no momento do cadastro."></i>
                                </label>
                                <input type="password" class="form-control rounded-pill" id="senha_seguranca_reset" name="senha_seguranca" required>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="nova_senha" class="form-label">
                                    Nova Senha
                                    <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Crie sua nova senha principal."></i>
                                </label>
                                <input type="password" class="form-control rounded-pill" id="nova_senha" name="nova_senha" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmar_nova_senha" class="form-label">
                                    Confirmar Nova Senha
                                    <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Digite a nova senha novamente para confirmar."></i>
                                </label>
                                <input type="password" class="form-control rounded-pill" id="confirmar_nova_senha" name="confirmar_nova_senha" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100 rounded-pill"><i class="bi bi-check-circle me-2"></i> Redefinir Senha</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="autenticacao.php?acao=login">Voltar para o Login</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="card rounded-4 card-hover-effect">
                    <div class="card-header text-center" style="background-color: #5AA4FA;">
                        <h3 class="my-2 text-light"><i class="bi bi-box-arrow-in-right me-2"></i> Login</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="autenticacao.php?acao=login" method="POST">
                            <div class="mb-3">
                                <label for="email_login" class="form-label">
                                    Email
                                    <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="O email que você cadastrou para acessar sua conta."></i>
                                </label>
                                <input type="email" class="form-control rounded-pill" id="email_login" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha_login" class="form-label">
                                    Senha
                                    <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Sua senha principal de acesso."></i>
                                </label>
                                <input type="password" class="form-control rounded-pill" id="senha_login" name="senha" required>
                            </div>
                            <button type="submit" class="btn btn-warning w-100 rounded-pill"><i class="bi bi-box-arrow-in-right me-2"></i> Entrar</button>
                            <div class="text-center mt-3">
                                <a href="autenticacao.php?acao=esqueci_senha" class="d-block">Esqueci minha senha?</a>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        Não tem uma conta? <a href="autenticacao.php?acao=cadastro">Cadastre-se</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    .card-hover-effect {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>

<?php
include __DIR__ . '/../includes/footer.php'; 
?>