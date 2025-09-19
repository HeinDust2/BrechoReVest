<div class="container my-5">
    <div class="card shadow p-4">
        <?php if (!isset($acao) || $acao !== 'configurar'): ?>
            <h2 class="text-center mb-4">Bem-vindo(a) ao Brechó Revest!</h2>
            <p class="text-center text-muted">Aproveite para configurar seu perfil ou comece a navegar agora mesmo.</p>

            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                <a href="first_step.php?acao=configurar" class="btn btn-primary btn-lg">Configurar meu Perfil</a>
                <a href="first_step.php?acao=pular" class="btn btn-secondary btn-lg">Pular e Ir para a Vitrine</a>
            </div>
        <?php else: ?>
            <h2 class="text-center mb-4">Configurar Perfil</h2>
            <p class="text-center text-muted">Preencha as informações da sua loja para que os clientes possam te encontrar.</p>

            <?php if (!empty($mensagem_erro)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($mensagem_erro) ?></div>
            <?php endif; ?>

            <form action="first_step.php?acao=configurar" method="POST">
                <div class="mb-3">
                    <label for="nome_loja" class="form-label">Nome do Vendedor ou da Loja <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nome_loja" name="nome_loja" required>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="telefone" class="form-label">Telefone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="telefone" name="telefone" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="whatsapp" class="form-label">WhatsApp</label>
                        <input type="text" class="form-control" id="whatsapp" name="whatsapp">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="instagram" class="form-label">Instagram</label>
                        <input type="text" class="form-control" id="instagram" name="instagram">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="facebook" class="form-label">Facebook</label>
                        <input type="text" class="form-control" id="facebook" name="facebook">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="tiktok" class="form-label">TikTok</label>
                    <input type="text" class="form-control" id="tiktok" name="tiktok">
                </div>

                <hr>
                <h5 class="mb-3">Endereço da Loja</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label for="rua" class="form-label">Rua</label>
                        <input type="text" class="form-control" id="rua" name="rua">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" class="form-control" id="complemento" name="complemento">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="estado" name="estado">
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Salvar e Continuar</button>
                </div>
            </form>
            <p class="text-center mt-3"><a href="first_step.php?acao=pular">Prefiro pular esta etapa</a></p>
        <?php endif; ?>
    </div>
</div>

