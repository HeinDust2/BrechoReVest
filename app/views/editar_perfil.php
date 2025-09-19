<body>
<div class="container my-5">
    <div class="card shadow p-4">
        <h2 class="text-center mb-4">Editar Perfil</h2>

        <?php if(!empty($_SESSION['mensagem'])): ?>
            <div class="alert alert-<?= $_SESSION['tipo_mensagem'] ?? 'info' ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['mensagem']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']); ?>
        <?php endif; ?>

        <div class="row">
            <!-- Coluna esquerda: foto e senha -->
            <div class="col-md-4 mb-4">
                <h5 class="mb-3">Foto de Perfil</h5>
                <div class="d-flex flex-column align-items-center mb-4">
                    <img src="<?= htmlspecialchars($caminho_foto) ?>" class="rounded-circle mb-3 border border-3" style="width:150px;height:150px;object-fit:cover;">
                    
                    <form action="editar_perfil.php" method="POST" enctype="multipart/form-data" class="w-100">
                        <input type="hidden" name="acao" value="atualizar_foto">
                        <div class="mb-3">
                            <label for="foto_perfil" class="form-label">Escolher nova foto</label>
                            <input type="file" class="form-control" id="foto_perfil" name="foto_perfil">
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <button type="submit" class="btn btn-primary">Salvar Foto</button>
                            <?php if(!empty($usuario_db['foto_perfil'])): ?>
                                <button type="button" class="btn btn-danger" onclick="document.getElementById('form-remover-foto').submit();">Remover Foto</button>
                            <?php endif; ?>
                        </div>
                    </form>
                    <form id="form-remover-foto" action="editar_perfil.php" method="POST" class="d-none">
                        <input type="hidden" name="acao" value="remover_foto">
                    </form>

                </div>

                <hr>
                <h5 class="mb-3">Mudar Senha</h5>
                <div class="d-grid">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSenha">
                        Alterar Senha
                    </button>
                </div>
            </div>

            <!-- Coluna direita: formulário -->
            <div class="col-md-8">
                <h5 class="mb-3">Dados da Loja</h5>
                <form action="editar_perfil.php" method="POST">
                    <input type="hidden" name="acao" value="atualizar_perfil">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Seu Nome Completo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($usuario_db['nome'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nome_loja" class="form-label">Nome da Loja <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nome_loja" name="nome_loja" value="<?= htmlspecialchars($usuario_db['nome_loja'] ?? '') ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefone" class="form-label">Telefone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($usuario_db['telefone'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="whatsapp" class="form-label">WhatsApp</label>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?= htmlspecialchars($usuario_db['whatsapp'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="text" class="form-control" id="instagram" name="instagram" value="<?= htmlspecialchars($usuario_db['instagram'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="text" class="form-control" id="facebook" name="facebook" value="<?= htmlspecialchars($usuario_db['facebook'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tiktok" class="form-label">TikTok</label>
                        <input type="text" class="form-control" id="tiktok" name="tiktok" value="<?= htmlspecialchars($usuario_db['tiktok'] ?? '') ?>">
                    </div>

                    <hr>
                    <h5 class="mb-3">Endereço</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="cep" class="form-label">CEP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="cep" name="cep" value="<?= htmlspecialchars($usuario_db['cep'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="rua" class="form-label">Rua <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="rua" name="rua" value="<?= htmlspecialchars($usuario_db['rua'] ?? '') ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="numero" class="form-label">Número <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="numero" name="numero" value="<?= htmlspecialchars($usuario_db['numero'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control" id="complemento" name="complemento" value="<?= htmlspecialchars($usuario_db['complemento'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="bairro" class="form-label">Bairro <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="bairro" name="bairro" value="<?= htmlspecialchars($usuario_db['bairro'] ?? '') ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cidade" class="form-label">Cidade <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="cidade" name="cidade" value="<?= htmlspecialchars($usuario_db['cidade'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="estado" name="estado" value="<?= htmlspecialchars($usuario_db['estado'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-primary btn-lg">Atualizar Perfil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Alterar Senha -->
<div class="modal fade" id="modalSenha" tabindex="-1" aria-labelledby="modalSenhaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alterar Senha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="editar_perfil.php" method="POST">
                <input type="hidden" name="acao" value="mudar_senha">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="senha_atual" class="form-label">Senha Atual</label>
                        <input type="password" class="form-control" id="senha_atual" name="senha_atual" required>
                    </div>
                    <div class="mb-3">
                        <label for="nova_senha" class="form-label">Nova Senha</label>
                        <input type="password" class="form-control" id="nova_senha" name="nova_senha" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirma_senha" class="form-label">Confirmar Nova Senha</label>
                        <input type="password" class="form-control" id="confirma_senha" name="confirma_senha" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
<?php

?>