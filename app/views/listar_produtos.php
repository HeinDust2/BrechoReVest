<!-- listar_produtos.php view -->
<main class="container my-4">
    <h2 class="mb-4 text-center text-primary">Produtos Disponíveis</h2>

    <?php if ($resultado->num_rows > 0): ?>
        <!-- Otimização da grade para dispositivos móveis. Em telas menores, 2 colunas. -->
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3">
            <?php while ($row = $resultado->fetch_assoc()):
                // Define o caminho para a imagem de visualização
                $imagens = !empty($row['imagem']) ? unserialize($row['imagem']) : [];
                $imagem_preview = (!empty($imagens) && is_array($imagens) && file_exists('../public/uploads/' . $imagens[0]))
                    ? '../public/uploads/' . $imagens[0]
                    : '../public/assets/imagens/placeholder.png';
            ?>
                <div class="col">
                    <!-- O card agora tem um arredondamento maior, uma sombra mais suave e um efeito de hover.
                         A classe shadow-lg foi removida para usar uma sombra personalizada. -->
                    <div class="card h-100 rounded-4 card-hover-effect">
                        <a href="ver_produto.php?id=<?= $row['id'] ?>" class="text-decoration-none text-dark">
                            <img src="<?= htmlspecialchars($imagem_preview) ?>" class="card-img-top img-fluid rounded-top-4" alt="<?= htmlspecialchars($row['nome']) ?>" style="height:180px; object-fit:cover;">
                            <div class="card-body d-flex flex-column p-3">
                                <!-- Título do produto com a cor #5AA4FA (azul) -->
                                <h5 class="card-title text-truncate text-info">
                                    <?= htmlspecialchars($row['nome']) ?>
                                </h5>
                                <p class="card-text text-truncate mb-2 text-secondary">
                                    <?= htmlspecialchars($row['descricao']) ?>
                                </p>
                                <!-- Preço com ícone de preço e cor #198754 (verde) -->
                                <p class="fw-bold mb-1 text-success">
                                    <i class="bi bi-tag me-1"></i> R$ <?= number_format($row['preco'], 2, ',', '.') ?>
                                </p>
                                <!-- Informações da loja com ícone e cor #ffc107 (amarelo) -->
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-shop me-1 text-warning"></i>
                                    <a href="perfil_loja.php?id=<?= $row['usuario_id'] ?>" class="text-decoration-none text-secondary">
                                        <?= htmlspecialchars($row['vendedor']) ?>
                                    </a>
                                </p>
                                <!-- Informação do bairro com ícone e cor #dc3545 (vermelho) -->
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-geo-alt me-1 text-danger"></i>
                                    <span class="text-secondary"><?= htmlspecialchars($row['bairro_loja'] ?? 'Não informado') ?></span>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="alert alert-info text-center">Nenhum produto encontrado.</p>
    <?php endif; ?>
</main>
<style>
    /* Estilo para a classe card-hover-effect */
    .card-hover-effect {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        /* Sombra inicial mais suave e difusa */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); 
    }

    .card-hover-effect:hover {
        transform: translateY(-5px);
        /* Sombra no hover mais pronunciada, mas ainda suave */
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12); 
    }
    
    /* Cores personalizadas para o design */
    .text-primary { color: #5AA4FA !important; }
    .text-info { color: #5AA4FA !important; }
    .text-success { color: #198754 !important; }
    .text-warning { color: #ffc107 !important; }
    .text-danger { color: #dc3545 !important; }
    .text-secondary { color: #6c757d !important; }

    /* Estilo da fonte com bordas arredondadas e suavizadas */
    body {
        font-family: 'Poppins', sans-serif;
    }

    /* Ajuste para telas menores */
    @media (max-width: 576px) {
        .row-cols-2 {
            --bs-gutter-x: 0.5rem;
            --bs-gutter-y: 0.5rem;
        }
        .card-img-top {
            height: 120px !important;
        }
        .card-title, .card-text {
            font-size: 0.8rem;
        }
    }
</style>
