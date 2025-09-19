<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Produto: <?= htmlspecialchars($produto['nome'] ?? 'Produto não encontrado') ?></title>
    <style>
        /* Estilos personalizados */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .text-primary { color: #5AA4FA !important; }
        .text-success { color: #198754 !important; }
        .text-warning { color: #ffc107 !important; }
        .text-danger { color: #dc3545 !important; }
        .text-secondary { color: #6c757d !important; }

        /* Estilo do Card com sombra suave e efeito de hover */
        .card-hover-effect {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            box-sh
            adow: 0 5px 15px rgba(0, 0, 0, 0.08); 
        }
        
        .card-hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12); 
        }

        /* Botões do carrossel mais estilosos */
        .carousel-control-prev, 
        .carousel-control-next {
            width: 50px;
            height: 50px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(90, 164, 250, 0.8);
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        .carousel-control-prev:hover, 
        .carousel-control-next:hover {
            background: rgba(90, 164, 250, 1);
            transform: translateY(-50%) scale(1.1);
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(1); /* deixa o ícone branco */
        }
        
        /* Ajuste para telas menores */
        @media (max-width: 576px) {
            .carousel-inner {
                height: 300px;
            }
            .card-title, .card-text {
                font-size: 0.8rem;
            }
            .carousel-item img {
                object-fit: cover;
                height: 100%;
                width: 100%;
            }
        }
    </style>
</head>
<body>

<main class="container my-5">
    <?php if (isset($_SESSION['mensagem'])): ?>
        <div class="alert alert-<?= $_SESSION['tipo_mensagem'] ?> alert-dismissible fade show rounded-4" role="alert">
            <?= htmlspecialchars($_SESSION['mensagem']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']); ?>
    <?php endif; ?>

    <?php if ($produto): ?>
        <div class="row">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="card rounded-4 card-hover-effect p-3 d-flex flex-column">
                    <?php
                    // Deserializa as imagens do banco de dados
                    $imagens = !empty($produto['imagem']) ? unserialize($produto['imagem']) : [];
                    $placeholder_url = 'imagens/placeholder.png';
                    
                    if (!empty($imagens) && is_array($imagens)):
                    ?>
                        <div id="productCarousel" class="carousel slide w-100" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <?php foreach ($imagens as $key => $imagem_nome): ?>
                                    <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="<?= $key ?>" class="<?= $key === 0 ? 'active' : '' ?>" aria-current="<?= $key === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $key + 1 ?>"></button>
                                <?php endforeach; ?>
                            </div>
                            <div class="carousel-inner rounded-4" style="height: auto;">
                                <?php foreach ($imagens as $key => $imagem_nome):
                                    $caminho_imagem = 'uploads/' . htmlspecialchars($imagem_nome);
                                    $caminho_final = file_exists($caminho_imagem) ? $caminho_imagem : $placeholder_url;
                                ?>
                                    <div class="carousel-item <?= $key === 0 ? 'active' : '' ?>">
                                        <img src="<?= $caminho_final ?>" class="d-block w-100" style="height: auto; max-height: none;" alt="Imagem do produto <?= $key + 1 ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="d-flex justify-content-center align-items-center w-100 h-100">
                           <img src="<?= $placeholder_url ?>" class="img-fluid rounded-4" alt="Imagem do produto não encontrada">
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card rounded-4 card-hover-effect p-4 d-flex flex-column justify-content-between">
                    <div>
                        <h1 class="text-primary" style="font-weight: 600;"><?= htmlspecialchars($produto['nome']) ?></h1>
                        <p class="fs-4 text-success" style="font-weight: 600;">
                            <i class="bi bi-tag me-2"></i> R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                        </p>
                        <hr class="text-muted">

                        <div class="d-flex gap-3 mb-4">
                            <a href="perfil_loja.php?id=<?= $produto['usuario_id'] ?>" class="btn btn-outline-secondary w-50 rounded-pill">
                                <i class="bi bi-chat-dots me-2"></i> Contato
                            </a>
                            <?php if (isset($_SESSION['usuario'])): ?>
                                <?php if ($produto['status_reserva'] === 'disponivel'): ?>
                                    <a href="acoes_produto.php?acao=reservar&id=<?= $produto['id'] ?>" class="btn btn-success w-50 rounded-pill">
                                        <i class="bi bi-cart-plus me-2"></i> Reservar Produto
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-warning w-50 rounded-pill" disabled>
                                        <i class="bi bi-calendar-x me-2"></i> Produto Reservado
                                    </button>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="autenticacao.php?acao=login" class="btn btn-success w-50 rounded-pill">
                                    <i class="bi bi-cart-plus me-2"></i> Faça login para reservar
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="mb-4 p-3 rounded-4" style="background-color: #f8f9fa;">
                            <h5 class="text-secondary" style="font-weight: 600;"><i class="bi bi-info-circle me-2"></i> Descrição</h5>
                            <p class="text-dark m-0"><?= htmlspecialchars($produto['descricao']) ?></p>
                        </div>
                        
                       
                        
                        <div class="mb-4 p-3 rounded-4" style="background-color: #f8f9fa;">
                            <h5 class="text-secondary" style="font-weight: 600;"><i class="bi bi-card-list me-2"></i> Detalhes do Produto</h5>
                            <p class="mb-1"><strong><i class="bi bi-person-fill me-2"></i>Tipo de Roupa:</strong> <?= htmlspecialchars($produto['tipo_roupa'] ?? 'Não informado') ?></p>
                            <p class="mb-1"><strong><i class="bi bi-tags-fill me-2"></i>Estilo:</strong> <?= htmlspecialchars($produto['estilo'] ?? 'Não informado') ?></p>
                            <p class="mb-1"><strong><i class="bi bi-rulers me-2"></i>Tamanho:</strong> <?= htmlspecialchars($produto['tamanho'] ?? 'Não informado') ?></p>
                            <p class="mb-1"><strong><i class="bi bi-palette me-2"></i>Cor:</strong> <?= htmlspecialchars($produto['cor'] ?? 'Não informado') ?></p>
                            <p class="mb-1"><strong><i class="bi bi-box-seam me-2"></i>Materiais:</strong> <?= htmlspecialchars($produto['materiais'] ?? 'Não informado') ?></p>
                            <p class="mb-0"><strong><i class="bi bi-calendar-event me-2"></i>Data do Anúncio:</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($produto['data_cadastro'] ?? 'now'))) ?></p>
                        </div>

                       <?php
                            $formas_pagamento = !empty($produto['pagamento']) ? unserialize($produto['pagamento']) : [];

                            if (!empty($formas_pagamento)) {
                                echo '<div class="mb-4 p-3 rounded-4" style="background-color: #f8f9fa;">';
                                echo '<h5 class="text-secondary mb-3" style="font-weight: 600;"><i class="bi bi-credit-card me-2"></i> Formas de Pagamento</h5>';
                                echo '<div class="d-flex flex-wrap gap-2">';
                                
                                foreach ($formas_pagamento as $forma) {
                                    // Escolha do ícone conforme a forma de pagamento
                                    $icone = match($forma) {
                                        'Pix' => 'bi-piggy-bank',
                                        'Crédito', 'Cartão de Crédito' => 'bi-credit-card',
                                        'Débito', 'Cartão de Débito' => 'bi-bank',
                                        'Dinheiro' => 'bi-cash-stack',
                                        'Boleto' => 'bi-receipt',
                                        default => 'bi-credit-card'
                                    };
                                    
                                    echo '<span class="d-flex align-items-center px-3 py-2 rounded-pill bg-white border text-dark shadow-sm">';
                                    echo "<i class='bi $icone me-2'></i>" . htmlspecialchars($forma);
                                    echo '</span>';
                                }
                                
                                echo '</div>';
                                echo '</div>';
                            }
                        ?>
 
                                



                        <div class="mb-4 p-3 rounded-4" style="background-color: #f8f9fa;">
                            <h5 class="text-secondary" style="font-weight: 600;"><i class="bi bi-shop me-2"></i> Informações do Vendedor</h5>
                            <div class="d-flex align-items-center mb-1">
                                <a href="perfil_loja.php?id=<?= $produto['usuario_id'] ?>" class="text-decoration-none text-dark d-flex align-items-center">
                                    <i class="bi bi-person-circle fs-4 me-2"></i>
                                    <span style="font-weight: 500;">
                                        <?= htmlspecialchars($produto['vendedor']) ?>
                                    </span>
                                </a>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                                <small class="text-muted">Bairro: <?= htmlspecialchars($produto['bairro_loja'] ?? 'Não informado') ?></small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger rounded-4" role="alert">Produto não encontrado.</div>
    <?php endif; ?>
</main>

</body>
</html>