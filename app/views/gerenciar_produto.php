<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" href="../public/assets/imagens/favicon.png" type="image/png">
    
    <style>
        /* Seu CSS já existente */
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .payment-option-card { display:flex; flex-direction:column; align-items:center; justify-content:center; padding:0.3rem 1rem; border:2px solid #e9ecef; border-radius:0.75rem; cursor:pointer; transition:all 0.3s ease; text-align:center; min-width:100px; }
        .payment-option-card:hover { border-color:#0d6efd; background-color:#f1f7fe; }
        .payment-checkbox { display:none; }
        .payment-checkbox:checked + .payment-option-card { border-color:#198754; background-color:#d1e7dd; box-shadow:0 0 10px rgba(25,135,84,0.2); }
        .payment-option-card i { font-size:2.5rem; color:#6c757d; transition:color 0.3s ease; }
        .payment-checkbox:checked + .payment-option-card i { color:#198754; }
        .payment-option-card small { margin-top:0.5rem; font-weight:500; color:#495057; }
        .form-label { font-weight:500;  }
        .card-shadow { box-shadow:0 5px 15px rgba(0,0,0,0.08); border-radius:1rem; }
        .image-preview-container { display:flex; flex-wrap:wrap; gap:1rem; margin-top:1rem; }
        .image-preview { position:relative; width:100px; height:100px; border-radius:0.5rem; overflow:hidden; box-shadow:0 2px 5px rgba(0,0,0,0.1); }
        .image-preview img { width:100%; height:100%; object-fit:cover; }
        .delete-image-overlay { position:absolute; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.6); display:flex; align-items:center; justify-content:center; opacity:0; transition:opacity 0.3s ease; cursor:pointer; }
        .image-preview:hover .delete-image-overlay { opacity:1; }
        .delete-image-overlay i { color:#fff; font-size:1.5rem; }
        
        /* Estilos para o acordeão padrão */
        .accordion-button.collapsed{background-color: #5AA4FA; color: white}
        /* .accordion-body {background-color: #5AA4FA;}*/
        .accordion-header .btn {
            font-weight: 600;
            color: #5AA4FA;
        }
        .accordion-button:not(.collapsed) {
            color: white;
            background-color: #5AA4FA;
        }

        /* Estilos adicionados para a validação visual */
        .campo-valido {
            border-color: #198754 !important; /* Verde */
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25) !important;
        }
        .campo-invalido {
            border-color: #dc3545 !important; /* Vermelho */
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
        }

        /* Cores para o botão do acordeão */
        .accordion-button.campo-valido {
            background-color: #198754 !important; /* Verde */
            color: white !important;
        }
        .accordion-button.campo-invalido {
            background-color: #dc3545 !important; /* Vermelho */
            color: white !important;
        }

        /* Estilo para o título */
        .titulo-custom {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #5AA4FA; /* Cor azul personalizada para o título */
        }
    </style>
</head>
<body>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-shadow p-4 mb-4">
                <h2 class="card-title text-center mb-4 titulo-custom">Adicionar Novo Produto</h2>

                <?php if (!empty($mensagem)): ?>
                    <div class="alert alert-<?= $tipo_mensagem ?> alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($mensagem) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="gerenciar_produto.php" method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                    <?php if ($produto): ?>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>">
                    <?php endif; ?>

                    <div class="accordion" id="productAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    1. Informações Básicas
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#productAccordion">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome do Produto: <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Digite um nome claro e atrativo para o seu produto."></i></label>
                                        <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($produto['nome'] ?? '') ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descricao" class="form-label">Descrição detalhada: <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Seja detalhado. Inclua informações sobre o tecido, caimento e ocasiões de uso."></i></label>
                                        <textarea class="form-control" id="descricao" name="descricao" rows="4"><?= htmlspecialchars($produto['descricao'] ?? '') ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="preco" class="form-label">Preço R$: <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Insira o preço do produto. Use ponto ou vírgula para centavos."></i></label>
                                        <input type="number" class="form-control" id="preco" name="preco" step="0.01" value="<?= htmlspecialchars($produto['preco'] ?? '') ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    2. Características da Roupa
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                                <div class="accordion-body" >
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="tamanho" class="form-label">Tamanho:</label>
                                            <select class="form-select" id="tamanho" name="tamanho" required>
                                                <option value="">Selecione um tamanho</option>
                                                <?php
                                                $tamanhos = ['PP','P','M','G','GG','XG','Tamanho Único','36','38','40','42','44','46'];
                                                $tamanho_selecionado = $produto['tamanho'] ?? '';
                                                foreach ($tamanhos as $tamanho_opt) {
                                                    $selected = ($tamanho_opt == $tamanho_selecionado) ? 'selected' : '';
                                                    echo "<option value='".htmlspecialchars($tamanho_opt)."' {$selected}>".htmlspecialchars($tamanho_opt)."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="tipo_roupa" class="form-label">Tipo:</label>
                                            <select class="form-select" id="tipo_roupa" name="tipo_roupa">
                                                <option value="">Selecione um tipo</option>
                                                <?php
                                                $tipos = ['Blusa','Vestido','Calça','Saia','Jaqueta','Casaco','Shorts','Macacão'];
                                                $tipo_selecionado = $produto['tipo_roupa'] ?? '';
                                                foreach ($tipos as $tipo_opt) {
                                                    $selected = ($tipo_opt == $tipo_selecionado) ? 'selected' : '';
                                                    echo "<option value='".htmlspecialchars($tipo_opt)."' {$selected}>".htmlspecialchars($tipo_opt)."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="estilo" class="form-label">Estilo:</label>
                                            <select class="form-select" id="estilo" name="estilo">
                                                <option value="">Selecione um estilo</option>
                                                <?php
                                                $estilos = ['Casual','Social','Esportivo','Vintage','Festa','Romântico'];
                                                $estilo_selecionado = $produto['estilo'] ?? '';
                                                foreach ($estilos as $estilo_opt) {
                                                    $selected = ($estilo_opt == $estilo_selecionado) ? 'selected' : '';
                                                    echo "<option value='".htmlspecialchars($estilo_opt)."' {$selected}>".htmlspecialchars($estilo_opt)."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cor" class="form-label">Cor: <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Ex: Azul-marinho, Verde-menta."></i></label>
                                            <input type="text" class="form-control" id="cor" name="cor" value="<?= htmlspecialchars($produto['cor'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="materiais" class="form-label">Materiais: <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Liste os materiais principais do produto. Ex: Algodão, Poliéster, Couro."></i></label>
                                        <input type="text" class="form-control" id="materiais" name="materiais" value="<?= htmlspecialchars($produto['materiais'] ?? '') ?>">
                                        <div class="form-text">Ex: Algodão, Poliéster, Couro.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    3. Formas de Pagamento
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                                <div class="accordion-body">
                                    <div class="mb-4 text-center">
                                        <label class="form-label d-block">Selecione as formas de pagamento aceitas: <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Selecione ao menos uma forma de pagamento."></i></label>
                                        <div class="d-flex flex-wrap gap-3 justify-content-center mt-2">
                                            <?php
                                            $pagamentos_selecionados = $produto['pagamento'] ?? [];
                                            $opcoes_pagamento = ['Pix'=>'bi-qr-code','Crédito'=>'bi-credit-card','Dinheiro'=>'bi-cash-stack','Boleto'=>'bi-receipt'];
                                            foreach ($opcoes_pagamento as $opcao=>$icone) {
                                                $checked = in_array($opcao,$pagamentos_selecionados)?'checked':'';
                                                echo '<div class="d-flex flex-column">';
                                                echo "<input type='checkbox' id='pagamento_".str_replace(' ','_',$opcao)."' name='pagamento[]' value='".htmlspecialchars($opcao)."' class='payment-checkbox' $checked>";
                                                echo "<label for='pagamento_".str_replace(' ','_',$opcao)."' class='payment-option-card'>";
                                                echo "<i class='bi ".htmlspecialchars($icone)."'></i>";
                                                echo '<small>'.htmlspecialchars($opcao).'</small>';
                                                echo '</label>';
                                                echo '</div>';
                                            }
                                            ?>
                                        </div>
                                        <div id="pagamento_error" class="text-danger mt-2" style="display:none;">Selecione pelo menos uma forma de pagamento.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    4. Imagens do Produto
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                        <label for="imagens" class="form-label">Adicionar Imagens: <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Adicione de 1 a 5 imagens para o seu produto."></i></label>
                                        <input type="file" class="form-control" id="imagens" name="imagens[]" multiple accept="image/*" <?= !$produto ? 'required' : '' ?>>
                                    </div>

                                    <?php if ($produto && !empty($produto['imagem'])): ?>
                                        <div class="mb-4">
                                            <label class="form-label">Imagens Atuais (marcar para excluir):</label>
                                            <div class="image-preview-container">
                                                <?php
                                                // Verifica se a imagem é uma string serializada e a desserializa
                                                $imagens_array = is_string($produto['imagem']) ? unserialize($produto['imagem']) : $produto['imagem'];
                                                
                                                if (is_array($imagens_array)):
                                                    foreach ($imagens_array as $imagem_nome): ?>
                                                        <div class="image-preview">
                                                            <img src="../../public/uploads/<?= htmlspecialchars($imagem_nome) ?>" alt="Imagem do Produto">
                                                            <label class="delete-image-overlay" title="Clique para excluir">
                                                                <input type="checkbox" name="excluir_imagens[]" value="<?= htmlspecialchars($imagem_nome) ?>" class="d-none">
                                                                <i class="bi bi-x-circle-fill"></i>
                                                            </label>
                                                        </div>
                                                <?php endforeach;
                                                endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Salvar Produto</button>
                    </div>
                    <div class="text-center mt-2">
                        <a href="meus_produtos.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>

<script>
    // Inicializa todos os tooltips na página
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Função para verificar um campo individualmente e aplicar as classes
    function verificarCampo(campo) {
        if (campo.value.trim() !== '' && campo.value !== 'Selecione um tamanho' && campo.value !== 'Selecione um tipo' && campo.value !== 'Selecione um estilo') {
            campo.classList.add('campo-valido');
            campo.classList.remove('campo-invalido');
            return true;
        } else {
            campo.classList.add('campo-invalido');
            campo.classList.remove('campo-valido');
            return false;
        }
    }

    // Função para verificar todos os campos de um acordeão e atualizar o botão
    function verificarAcordeao(accordionId) {
        const accordionBody = document.getElementById(accordionId);
        if (!accordionBody) return;

        const campos = accordionBody.querySelectorAll('input, textarea, select');
        let todosPreenchidos = true;

        campos.forEach(campo => {
            if (campo.tagName === 'SELECT') {
                if (campo.value === '' || campo.value.startsWith('Selecione')) {
                    todosPreenchidos = false;
                }
            } else if (campo.type === 'file') {
                // Se for um campo de arquivo e for obrigatório, verifica se há arquivos
                if (campo.hasAttribute('required') && campo.files.length === 0) {
                    todosPreenchidos = false;
                }
                // Se houver imagens atuais e o campo de upload estiver vazio, ele é considerado preenchido
                const imagensAtuais = document.querySelector('.image-preview-container');
                if (imagensAtuais && campo.files.length === 0) {
                     todosPreenchidos = true;
                }
            } else if (campo.type === 'checkbox' && campo.name.includes('pagamento')) {
                const checkboxesPagamento = document.querySelectorAll('input[name="pagamento[]"]');
                let isPagamentoChecked = Array.from(checkboxesPagamento).some(cb => cb.checked);
                if (!isPagamentoChecked) {
                    todosPreenchidos = false;
                }
            } else if (campo.value.trim() === '' && campo.hasAttribute('required')) {
                todosPreenchidos = false;
            }
        });

        // Atualiza a cor do botão do acordeão
        const accordionButton = accordionBody.previousElementSibling.querySelector('.accordion-button');
        if (todosPreenchidos) {
            accordionButton.classList.add('campo-valido');
            accordionButton.classList.remove('campo-invalido');
        } else {
            accordionButton.classList.add('campo-invalido');
            accordionButton.classList.remove('campo-valido');
        }
    }

    // Aplica a verificação visual em tempo real ao perder o foco (blur) ou ao mudar a seleção
    const camposValidacao = document.querySelectorAll('input[type="text"], input[type="number"], textarea, select, input[type="file"], input[type="checkbox"]');
    
    camposValidacao.forEach(campo => {
        campo.addEventListener('blur', function() {
            verificarCampo(this);
            const accordionId = this.closest('.accordion-collapse').id;
            verificarAcordeao(accordionId);
        });
        campo.addEventListener('change', function() {
            verificarCampo(this);
            const accordionId = this.closest('.accordion-collapse').id;
            verificarAcordeao(accordionId);
        });
    });

    // Verificação visual para os checkboxes de pagamento
    const checkboxesPagamento = document.querySelectorAll('input[name="pagamento[]"]');
    checkboxesPagamento.forEach(cb => {
        cb.addEventListener('change', function() {
            // Recalcula o estado de todos os checkboxes para aplicar o estilo corretamente
            let isPagamentoChecked = Array.from(checkboxesPagamento).some(c => c.checked);

            checkboxesPagamento.forEach(c => {
                c.nextElementSibling.style.borderColor = isPagamentoChecked ? '#198754' : '#dc3545';
                c.nextElementSibling.style.boxShadow = isPagamentoChecked ? '0 0 10px rgba(25,135,84,0.2)' : '0 0 10px rgba(220, 53, 69, 0.2)';
            });

            const accordionId = this.closest('.accordion-collapse').id;
            verificarAcordeao(accordionId);
        });
    });

    // Adiciona a verificação visual quando a página carrega
    window.addEventListener('load', function() {
        const acordeoes = ['collapseOne', 'collapseTwo', 'collapseThree', 'collapseFour'];
        acordeoes.forEach(id => {
            verificarAcordeao(id);
        });
    });

    // Função de validação final para o formulário
    function validarFormulario() {
        // Validação principal das formas de pagamento
        const pagamentoCheckboxes = document.querySelectorAll('input[name="pagamento[]"]');
        const pagamentoError = document.getElementById('pagamento_error');
        let isPagamentoChecked = Array.from(pagamentoCheckboxes).some(cb => cb.checked);

        if (!isPagamentoChecked) {
            pagamentoError.style.display = 'block';
            const collapseElement = document.getElementById('collapseThree');
            const bsCollapse = new bootstrap.Collapse(collapseElement, { toggle: false });
            bsCollapse.show();
            return false;
        } else {
            pagamentoError.style.display = 'none';
        }
        return true;
    }
</script>

</body>
</html>