<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Estilos personalizados para consistência */
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        .card-hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        /* Estilo para a imagem do card */
        .card-img-top {
            height: 250px;
            object-fit: cover;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }

        /* Estilo para o footer do card */
        .card-footer {
            background-color: #fff;
            border-top: none;
            border-bottom-left-radius: 1rem;
            border-bottom-right-radius: 1rem;
        }

        /* Estilo para o modal */
        .modal-content {
            border-radius: 1rem;
        }

        /* Estilo para a mensagem de não-reservas */
        .empty-state {
            text-align: center;
            margin-top: 5rem;
            padding: 2rem;
            border-radius: 1rem;
            background-color: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        /* AQUI ESTÁ O NOVO CSS PARA A FUNÇÃO DO CARD */
        .card {
            position: relative; /* Define o contexto de posicionamento */
        }
        .card-link-overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1; /* Garante que o link fique "por baixo" dos botões */
            /* Esconde o link, mas o torna clicável */
            text-indent: -9999px;
            overflow: hidden;
        }
        .card-footer, .card-body h5, .card-body p {
            position: relative;
            z-index: 2; /* Faz com que os botões e texto fiquem por cima do link */
        }
        /* Remove o sublinhado do link */
        .card-link-overlay:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>

<main class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4 text-primary" style="font-weight: 600;"><i class="bi bi-cart-check me-2"></i>Meu Carrinho</h2>

            <?php if (isset($_SESSION['mensagem'])): ?>
                <div class="alert alert-<?= $_SESSION['tipo_mensagem'] ?> alert-dismissible fade show rounded-4" role="alert">
                    <?= htmlspecialchars($_SESSION['mensagem']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']); ?>
            <?php endif; ?>
            
            <?php if ($resultado->num_rows > 0): ?>
                <div class="row row-cols-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                    <?php while ($produto = $resultado->fetch_assoc()):
                        $imagens = !empty($produto['imagem']) ? unserialize($produto['imagem']) : [];
                        $imagem_preview = (!empty($imagens) && is_array($imagens) && file_exists('uploads/' . $imagens[0])) ? 'uploads/' . $imagens[0] : 'imagens/placeholder.png';
                    ?>
                        <div class="col">
                            <div class="card h-100 rounded-4 card-hover-effect">
                                <a href="ver_produto.php?id=<?= htmlspecialchars($produto['id']) ?>" class="card-link-overlay">Ver produto</a>

                                <img src="<?= htmlspecialchars($imagem_preview) ?>" class="card-img-top" alt="<?= htmlspecialchars($produto['nome']) ?>">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title text-primary" style="font-weight: 600;"><?= htmlspecialchars($produto['nome']) ?></h5>
                                        <p class="card-text text-success fs-5" style="font-weight: 600;">R$ <?= htmlspecialchars(number_format($produto['preco'], 2, ',', '.')) ?></p>
                                    </div>
                                    <p class="card-text mt-auto">
                                        <small class="text-muted"><i class="bi bi-shop me-1"></i>Vendido por: <?= htmlspecialchars($produto['nome_loja'] ?? 'Loja não informada') ?></small>
                                    </p>
                                </div>
                                <div class="card-footer d-grid gap-2">
                                    <a href="https://wa.me/<?= htmlspecialchars(preg_replace('/[^0-9]/', '', $produto['telefone'])) ?>" target="_blank" class="btn btn-success w-100 rounded-pill">
                                        <i class="bi bi-whatsapp me-1"></i> Contactar Vendedor
                                    </a>
                                    <button type="button" class="btn btn-warning w-100 rounded-pill" data-bs-toggle="modal" data-bs-target="#cancelModal<?= htmlspecialchars($produto['id']) ?>">
                                        <i class="bi bi-calendar-x me-1"></i> Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="cancelModal<?= htmlspecialchars($produto['id']) ?>" tabindex="-1" aria-labelledby="cancelModalLabel<?= htmlspecialchars($produto['id']) ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4">
                                    <div class="modal-header border-0 pb-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center pt-0">
                                        <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;"></i>
                                        <h5 class="modal-title mt-3" id="cancelModalLabel<?= htmlspecialchars($produto['id']) ?>">Confirmar Cancelamento</h5>
                                        <p class="mt-2">Tem certeza que deseja cancelar a reserva do produto <strong><?= htmlspecialchars($produto['nome']) ?></strong>?</p>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center border-0">
                                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Não</button>
                                        <a href="acoes_produto.php?acao=cancelar_reserva&id=<?= htmlspecialchars($produto['id']) ?>" class="btn btn-warning rounded-pill">Sim, Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-bag-plus fs-1 text-primary mb-3"></i>
                    <h3>Você não possui nenhuma reserva no momento.</h3>
                    <p class="text-muted">Explore a loja para encontrar seu próximo item favorito!</p>
                    <a href="index.php" class="btn btn-primary rounded-pill mt-3">Ver Produtos Disponíveis</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>