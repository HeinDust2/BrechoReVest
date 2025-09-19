<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brechó & Moda Sustentável</title>
    <!-- Inclui a biblioteca Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Inclui o Bootstrap CSS -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .clickable-card {
            display: block; /* Garante que o link ocupe todo o espaço do card */
            text-decoration: none; /* Remove o sublinhado do link */
            color: inherit; /* Mantém a cor do texto padrão */
            transition: transform 0.2s, box-shadow 0.2s; /* Adiciona uma transição suave */
        }
        .clickable-card:hover {
            transform: translateY(-5px); /* Efeito de elevação ao passar o mouse */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important; /* Aumenta a sombra */
        }
    </style>
</head>
<body class="bg-light text-dark">

    <!-- Main Container -->
    <div class="container my-5">

        <!-- Header Section -->
        <header class="text-center py-5">
            <h1 class="display-4 fw-bolder text-primary mb-2">Brechó & Moda Sustentável</h1>
            <p class="h5 text-secondary fw-light">Seu guia para notícias, eventos e a cultura do consumo consciente.</p>
        </header>

        <!-- Main Content Grid -->
        <main class="row g-4">

            <!-- News Section -->
            <section class="col-md-8">
                <div class="bg-white rounded-4 shadow p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h3 fw-bold text-dark mb-0">Últimas Notícias</h2>
                        <!-- Botão de postagem com link para a página de cadastro -->
                        <a href="cadastro_jornal.php" class="btn btn-primary rounded-pill fw-semibold shadow-sm">
                            <i class="fas fa-plus me-1"></i> Postar
                        </a>
                    </div>
                    <div class="d-flex flex-column">
                        <?php
                        if ($resultado_noticias->num_rows > 0) {
                            while ($row_noticia = $resultado_noticias->fetch_assoc()) {
                                $data_formatada = date("d/m/Y", strtotime($row_noticia['data_de_publicacao']));
                        ?>
                                <a href="ver_noticia.php?tipo=noticia&id=<?php echo htmlspecialchars($row_noticia['id']); ?>" class="clickable-card p-3 border-bottom last:border-bottom-0">
                                    <article class="d-flex flex-column flex-sm-row gap-4">
                                        <!-- Imagem da notícia -->
                                        <img src="uploads/<?php echo htmlspecialchars($row_noticia['imagem']); ?>" 
                                            alt="Imagem da notícia" class="rounded-3" style="width: 150px; height: 150px; object-fit: cover;"
                                            onerror="this.src='https://placehold.co/150x150/507d57/ffffff?text=BRECH%C3%93'">
                                        <div class="flex-grow-1">
                                            <!-- Autor e Data -->
                                            <div class="d-flex align-items-center gap-2 text-muted small mb-2">
                                                <span class="d-flex align-items-center"><i class="fas fa-user-circle me-1"></i> <?php echo htmlspecialchars($row_noticia['autor']); ?></span>
                                                <span class="d-flex align-items-center"><i class="fas fa-calendar-alt me-1"></i> <?php echo htmlspecialchars($data_formatada); ?></span>
                                            </div>
                                            <!-- Título de Resumo e corpo do texto -->
                                            <h4 class="h6 text-dark fw-bold mb-1"><?php echo nl2br(htmlspecialchars(substr($row_noticia['resumo'], 0, 150))) . '...'; ?>:</h4>
                                            <p class="text-dark mb-2"><?php echo nl2br(htmlspecialchars(substr($row_noticia['corpo_do_texto'], 0, 150))) . '...'; ?></p>
                                        </div>
                                    </article>
                                </a>
                        <?php
                            }
                        } else {
                            echo "<p class='text-center text-muted'>Nenhuma notícia encontrada.</p>";
                        }
                        ?>
                    </div>
                </div>
            </section>

            <!-- Events Section (Sidebar) -->
            <section class="col-md-4">
                <div class="bg-white rounded-4 shadow p-4">
                    <h2 class="h3 fw-bold text-dark mb-4">Próximos Eventos</h2>
                    <div class="d-flex flex-column gap-3">
                        <?php
                        if ($resultado_eventos->num_rows > 0) {
                            while ($row_evento = $resultado_eventos->fetch_assoc()) {
                                $data_inicio_formatada = date("d/m/Y", strtotime($row_evento['data_inicio_evento']));
                                $data_termino_formatada = !empty($row_evento['data_termino_evento']) ? date("d/m/Y", strtotime($row_evento['data_termino_evento'])) : 'Não informado';
                        ?>
                                <a href="ver_noticia.php?tipo=evento&id=<?php echo htmlspecialchars($row_evento['id']); ?>" class="clickable-card p-3 rounded-3 border">
                                    <article>
                                        <div class="d-flex align-items-center mb-2">
                                            <!-- Imagem do evento -->
                                            <img src="uploads/<?php echo htmlspecialchars($row_evento['imagem_evento']); ?>" 
                                                alt="Imagem do evento" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;"
                                                onerror="this.src='https://placehold.co/60x60/d4a373/ffffff?text=EVENTO'">
                                            <div class="flex-grow-1">
                                                <h3 class="h5 fw-semibold text-dark mb-0"><?php echo htmlspecialchars($row_evento['nome_evento']); ?></h3>
                                                <p class="text-muted small mb-0"><i class="fas fa-map-marker-alt me-1"></i> <?php echo htmlspecialchars($row_evento['local_evento']); ?></p>
                                            </div>
                                        </div>
                                        <p class="text-muted small mb-1"><i class="fas fa-calendar-alt me-1"></i> Data: <?php echo htmlspecialchars($data_inicio_formatada); ?> <?php echo !empty($row_evento['data_termino_evento']) ? ' a ' . htmlspecialchars($data_termino_formatada) : ''; ?></p>
                                        <p class="text-muted small mb-1"><i class="fas fa-clock me-1"></i> Horário: <?php echo htmlspecialchars($row_evento['hora_evento']); ?></p>
                                        <p class="text-dark small mb-2"><?php echo nl2br(htmlspecialchars(substr($row_evento['descricao_evento'], 0, 100))) . '...'; ?></p>
                                        <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                                            <span class="text-success fw-bold small"><i class="fas fa-check-circle me-1"></i> <?php echo htmlspecialchars($row_evento['confirmacoes']); ?> Eu vou!</span>
                                        </div>
                                    </article>
                                </a>
                        <?php
                            }
                        } else {
                            echo "<p class='text-center text-muted'>Nenhum evento futuro encontrado.</p>";
                        }
                        ?>
                    </div>
                </div>
            </section>
        </main>

        <!-- Newsletter Section -->
        <footer class="text-center py-5 mt-4 bg-white rounded-4 shadow p-4">
            <h3 class="h4 fw-bold text-dark mb-2">Quer saber mais?</h3>
            <p class="text-dark mb-3">Inscreva-se na nossa newsletter para receber as novidades em primeira mão!</p>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                <input type="email" placeholder="Seu e-mail" class="form-control rounded-3 border flex-grow-1" style="max-width: 300px;">
                <button class="btn btn-primary rounded-3 fw-semibold shadow">Inscreva-se</button>
            </div>
        </footer>
    </div>


</body>
</html>

<?php
// Fecha a conexão com o banco de dados
$con->close();
?>
