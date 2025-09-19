<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= $titulo_pagina ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { background-color: #f0f2f5; font-family: 'Inter', sans-serif; }
        .content-container { max-width: 900px; margin: 3rem auto; }
        .article-header { border-bottom: 1px solid #dee2e6; padding-bottom: 1.5rem; margin-bottom: 2rem; }
        .content-image-wrapper { max-width: 100%; height: auto; border-radius: 1rem; overflow: hidden; box-shadow: 0 0.5rem 1rem rgba(0,0,0,.1); }
        .content-image { width:100%; height:auto; display:block; object-fit:cover; }
        @media (min-width:768px) { .content-image-wrapper { max-width:40%; margin-left:auto; margin-right:auto; } }
        .author-info { font-style: italic; color:#6c757d; border-top:1px solid #dee2e6; padding-top:1rem; margin-top:2rem; }
        .icon-text { display:flex; align-items:center; gap:.5rem; }
    </style>
</head>
<body>
<div class="container content-container">
    <div class="bg-white rounded-4 shadow-lg p-4 p-md-5">
        <?php if ($conteudo): ?>
            <article>
                <header class="article-header text-start">
                    <h1 class="display-6 fw-bold mb-3 text-dark"><?= $titulo_pagina ?></h1>

                    <?php if ($tipo_conteudo === 'noticia'): ?>
                        <div class="d-flex justify-content-start flex-wrap gap-3 text-muted small">
                            <span class="icon-text"><i class="fas fa-user-circle"></i> Autor: <?= htmlspecialchars($conteudo['autor']) ?></span>
                            <span class="icon-text"><i class="fas fa-calendar-alt"></i> Publicado em: <?= htmlspecialchars((new DateTime($conteudo['data_de_publicacao']))->format('d/m/Y')) ?></span>
                        </div>

                    <?php elseif ($tipo_conteudo === 'evento'): ?>
                        <div class="d-flex justify-content-start flex-wrap gap-3 text-muted small">
                            <span class="icon-text"><i class="fas fa-calendar-days"></i> Início: <?= htmlspecialchars((new DateTime($conteudo['data_inicio_evento']))->format('d/m/Y')) ?></span>
                            <?php if (!empty($conteudo['data_termino_evento']) && $conteudo['data_termino_evento'] !== '0000-00-00'): ?>
                                <span class="icon-text"><i class="fas fa-calendar-days"></i> Término: <?= htmlspecialchars((new DateTime($conteudo['data_termino_evento']))->format('d/m/Y')) ?></span>
                            <?php endif; ?>
                            <span class="icon-text"><i class="fas fa-clock"></i> Horário: <?= htmlspecialchars($conteudo['hora_evento']) ?></span>
                            <span class="icon-text"><i class="fas fa-map-marker-alt"></i> Local: <?= htmlspecialchars($conteudo['local_evento']) ?></span>
                        </div>
                    <?php endif; ?>

                </header>

                <?php if ($imagem_caminho && file_exists($imagem_caminho)): ?>
                    <div class="text-center mb-4">
                        <div class="content-image-wrapper">
                            <img src="<?= $imagem_caminho ?>" alt="Imagem do Conteúdo" class="content-image">
                        </div>
                    </div>
                <?php endif; ?>

                <div class="content-body">
                    <?php if ($tipo_conteudo === 'noticia'): ?>
                        <p class="lead text-dark lh-base"><?= nl2br(htmlspecialchars($conteudo['corpo_do_texto'])) ?></p>
                        <?php if (!empty($conteudo['referencias'])): ?>
                            <div class="author-info">
                                <p><i class="fas fa-link"></i> <strong>Referências:</strong> <?= htmlspecialchars($conteudo['referencias']) ?></p>
                            </div>
                        <?php endif; ?>

                    <?php elseif ($tipo_conteudo === 'evento'): ?>
                        <p class="lead text-dark lh-base"><?= nl2br(htmlspecialchars($conteudo['descricao_evento'])) ?></p>

                        <!-- Botão Eu Vou / contador salvo no BD -->
                        <div class="text-center mt-4">
                            <button id="btnEuVou" class="btn btn-success btn-lg rounded-pill px-4 shadow-sm">
                                <i class="fas fa-check-circle me-2"></i> Eu vou (<span id="contador"><?= (int)($conteudo['confirmacoes'] ?? 0) ?></span>)
                            </button>
                        </div>

                    <?php endif; ?>
                </div>

            </article>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                <h2 class="text-danger">Erro: Conteúdo não encontrado.</h2>
                <p class="text-muted">Por favor, verifique se o link está correto.</p>
            </div>
        <?php endif; ?>

        <div class="text-center mt-5 pt-4 border-top">
            <a href="javascript:history.back()" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
                <i class="fas fa-arrow-left me-2"></i> Voltar
            </a>
        </div>
    </div>
</div>

<?php if ($conteudo && $tipo_conteudo === 'evento'): ?>
<script>
    const btnEuVou = document.getElementById("btnEuVou");
    const contador = document.getElementById("contador");

    btnEuVou.addEventListener("click", () => {
        fetch("", { // mesma página
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "id_evento=<?= $conteudo['id'] ?>"
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                contador.textContent = data.confirmacoes;

                // Travar botão
                btnEuVou.disabled = true;
                btnEuVou.innerHTML = `<i class="fas fa-check-circle me-2"></i> Presença confirmada (${data.confirmacoes})`;
            } else {
                alert("Erro ao confirmar presença. Tente novamente.");
            }
        });
    });
</script>

<?php endif; ?>

</body>
</html>
