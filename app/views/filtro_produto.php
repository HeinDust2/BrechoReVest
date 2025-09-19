<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtro de Produtos</title>
    <style>
        /* Mantém todo o CSS original do seu código */
        .card-hover-effect { transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
        .card-hover-effect:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.12); }
        .text-primary { color: #5AA4FA !important; }
        .text-info { color: #5AA4FA !important; }
        .text-success { color: #198754 !important; }
        .text-warning { color: #ffc107 !important; }
        .text-danger { color: #dc3545 !important; }
        .text-secondary { color: #6c757d !important; }
        body { font-family: 'Poppins', sans-serif; }
        .filter-form .form-control, .filter-form .form-select { border-radius: .75rem; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .filter-form .btn { border-radius: .75rem; }
        @media (max-width: 576px) { .row-cols-2 { --bs-gutter-x: 0.5rem; --bs-gutter-y: 0.5rem; } .card-img-top { height: 200px !important; } .card-title, .card-text { font-size: 0.8rem; } }
        .btn-toggle-filter { width: 100%; display: flex; justify-content: center; align-items: center; }
        @media (min-width: 992px) { .filter-sidebar { position: sticky; top: 2rem; align-self: flex-start; } }
    </style>
</head>
<body>

<main class="container my-4">
    <h2 class="mb-4 text-center text-primary">Produtos Disponíveis</h2>
    
    <div class="row">
        <div class="col-12 col-lg-3 filter-sidebar">
            <div class="mb-3 d-grid d-lg-none">
                <button class="btn btn-outline-primary btn-toggle-filter" type="button" data-bs-toggle="collapse" data-bs-target="#filtroCollapse" aria-expanded="<?= $filtros_ativos ? 'true' : 'false' ?>" aria-controls="filtroCollapse">
                    <span class="collapsed-text <?= $filtros_ativos ? 'd-none' : '' ?>">Mostrar Filtros</span>
                    <span class="expanded-text <?= $filtros_ativos ? '' : 'd-none' ?>">Esconder Filtros</span>
                    <i class="bi bi-caret-down-fill ms-2"></i>
                </button>
            </div>
            
            <div class="collapse d-lg-block <?= $filtros_ativos ? 'show' : '' ?>" id="filtroCollapse">
                <form class="filter-form mb-4 p-4 border rounded-4 bg-light" action="?" method="get">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="busca_nome" class="form-label">Nome ou Descrição</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" id="busca_nome" name="busca_nome" value="<?= htmlspecialchars($busca_nome) ?>" placeholder="Busque por nome ou descrição...">
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="bairro" class="form-label">Bairro</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                <input type="text" class="form-control" id="bairro" name="bairro" value="<?= htmlspecialchars($bairro) ?>" placeholder="Seu bairro...">
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="loja" class="form-label">Loja</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-shop"></i></span>
                                <input type="text" class="form-control" id="loja" name="loja" value="<?= htmlspecialchars($loja) ?>" placeholder="Nome da loja...">
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="materiais" class="form-label">Material</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
                                <input type="text" class="form-control" id="materiais" name="materiais" value="<?= htmlspecialchars($materiais_raw) ?>" placeholder="Ex: Algodão, Lã...">
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="cor" class="form-label">Cor</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-palette"></i></span>
                                <input type="text" class="form-control" id="cor" name="cor" value="<?= htmlspecialchars($cor) ?>" placeholder="Ex: Azul, Vermelho...">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label d-block">Preço</label>
                            <div class="row g-2">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                        <input type="number" step="0.01" class="form-control" id="preco_min" name="preco_min" value="<?= $preco_min !== null ? htmlspecialchars($preco_min) : '' ?>" placeholder="Mínimo">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                        <input type="number" step="0.01" class="form-control" id="preco_max" name="preco_max" value="<?= $preco_max !== null ? htmlspecialchars($preco_max) : '' ?>" placeholder="Máximo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="preco_ordem" class="form-label">Ordenar por Preço</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-sort-numeric-down-alt"></i></span>
                                <select class="form-select" id="preco_ordem" name="preco_ordem">
                                    <option value="">Sem Ordem</option>
                                    <option value="asc" <?= $preco_ordem === 'asc' ? 'selected' : '' ?>>Crescente</option>
                                    <option value="desc" <?= $preco_ordem === 'desc' ? 'selected' : '' ?>>Decrescente</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary px-4 w-100 mb-2">
                                <i class="bi bi-funnel me-2"></i>Aplicar Filtros
                            </button>
                            <a href="listar_produtos.php" class="btn btn-secondary px-4 w-100">
                                <i class="bi bi-x-circle me-2"></i>Limpar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12 col-lg-9">
            <?php if ($resultado->num_rows > 0): ?>
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-lg-4 g-3">
                    <?php while ($row = $resultado->fetch_assoc()):
                        $imagens = !empty($row['imagem']) ? unserialize($row['imagem']) : [];
                        $imagem_preview = (!empty($imagens) && is_array($imagens) && file_exists('../public/uploads/' . $imagens[0]))
                            ? '../public/uploads/' . $imagens[0]
                            : '../public/assets/imagens/placeholder.png';
                    ?>
                        <div class="col">
                            <div class="card h-100 rounded-4 card-hover-effect">
                                <a href="ver_produto.php?id=<?= $row['id'] ?>" class="text-decoration-none text-dark">
                                    <img src="<?= htmlspecialchars($imagem_preview) ?>" class="card-img-top img-fluid rounded-top-4" alt="<?= htmlspecialchars($row['nome']) ?>" style="height:240px; object-fit:cover;">
                                    <div class="card-body d-flex flex-column p-3">
                                        <h5 class="card-title text-truncate text-info"><?= htmlspecialchars($row['nome']) ?></h5>
                                        <p class="card-text text-truncate mb-2 text-secondary"><?= htmlspecialchars($row['descricao']) ?></p>
                                        <p class="fw-bold mb-1 text-success"><i class="bi bi-tag me-1"></i> R$ <?= number_format($row['preco'], 2, ',', '.') ?></p>
                                        <p class="text-muted small mb-0"><i class="bi bi-shop me-1 text-warning"></i>
                                            <a href="perfil_loja.php?id=<?= $row['usuario_id'] ?>" class="text-decoration-none text-secondary"><?= htmlspecialchars($row['vendedor']) ?></a>
                                        </p>
                                        <p class="text-muted small mb-0"><i class="bi bi-geo-alt me-1 text-danger"></i><span class="text-secondary"><?= htmlspecialchars($row['bairro_loja'] ?? 'Não informado') ?></span></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p class="alert alert-info text-center">Nenhum produto encontrado com os filtros selecionados.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.querySelector('.btn-toggle-filter');
    const collapseElement = document.getElementById('filtroCollapse');
    
    if (toggleButton && collapseElement) {
        const isExpanded = collapseElement.classList.contains('show');
        toggleButton.querySelector('i').classList.toggle('bi-caret-up-fill', isExpanded);
        toggleButton.querySelector('i').classList.toggle('bi-caret-down-fill', !isExpanded);

        toggleButton.addEventListener('click', function () {
            const isExpandedNow = collapseElement.classList.contains('show');
            toggleButton.querySelector('i').classList.toggle('bi-caret-up-fill', !isExpandedNow);
            toggleButton.querySelector('i').classList.toggle('bi-caret-down-fill', isExpandedNow);
        });
    }
});
</script>

</body>
</html>
