<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Conteúdo</title>
    <!-- Inclui o Bootstrap CSS -->
    <style>
        body {
            background-color: #f0f9ff; /* Azul muito claro para o fundo */
        }
        .conteudo-form-container {
            max-width: 700px;
        }
        .conteudo-form-card {
            background-color: #ffffff; /* Fundo branco do card */
        }
        .conteudo-form-label {
            font-weight: bold;
        }
        /* Estilos personalizados para as abas, agora em tons de azul */
        .conteudo-tab-link {
            background-color: #e0f2ff; /* Azul claro para abas inativas */
            color: #0c4a6e; /* Texto azul escuro */
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid transparent;
            border-bottom: none;
            padding: 0.75rem 1.5rem; /* Aumenta o tamanho dos retângulos */
        }
        .conteudo-tab-link:hover {
            background-color: #b3e0ff; /* Azul um pouco mais escuro no hover */
        }
        .conteudo-tab-link.active {
            font-weight: bold;
            color: #fff; /* Texto branco */
            background-color: #0864a7; /* Azul vibrante para a aba ativa */
            border-color: #0864a7;
            border-bottom: 1px solid #0864a7; /* Mantém a borda na aba ativa */
        }
        .btn-primary {
            background-color: #0864a7;
            border-color: #0864a7;
        }
        .btn-primary:hover {
            background-color: #0a77c3;
            border-color: #0a77c3;
        }
    </style>
</head>
<body>

<div class="container mt-5 p-4 rounded-4 shadow-lg conteudo-form-card conteudo-form-container">
    <h1 class="text-center mb-4 text-primary">Adicionar Novo Conteúdo</h1>
    
    <!-- Tab Navigation -->
    <ul class="nav nav-tabs nav-justified" id="conteudoTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="conteudo-tab-link active rounded-top-3" id="noticia-tab" data-bs-toggle="tab" data-bs-target="#noticia-tab-pane" type="button" role="tab" aria-controls="noticia-tab-pane" aria-selected="true">Adicionar Notícia</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="conteudo-tab-link rounded-top-3" id="evento-tab" data-bs-toggle="tab" data-bs-target="#evento-tab-pane" type="button" role="tab" aria-controls="evento-tab-pane" aria-selected="false">Adicionar Evento</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content border border-top-0 rounded-bottom-3 p-4">
        
        <!-- Tab Pane for Notícias -->
        <div class="tab-pane fade show active" id="noticia-tab-pane" role="tabpanel" aria-labelledby="noticia-tab" tabindex="0">
            <form action="cadastro_jornal.php" method="POST" enctype="multipart/form-data">
                <!-- Adiciona um campo oculto para identificar o formulário -->
                <input type="hidden" name="form_type" value="noticia">
                <!-- O campo de autor foi removido pois agora é vinculado automaticamente pelo usuário logado -->
                <div class="mb-3">
                    <label for="resumo" class="conteudo-form-label"></label>
                    <textarea placeholder="Título" class="form-control" id="resumo" name="resumo" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="corpo_do_texto" class="conteudo-form-label"></label>
                    <textarea placeholder="Corpo do Texto" class="form-control" id="corpo_do_texto" name="corpo_do_texto" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="data_de_publicacao" class="conteudo-form-label">Data de Publicação</label>
                    <input type="date" class="form-control" id="data_de_publicacao" name="data_de_publicacao" required>
                </div>
                <div class="mb-3">
                    <label for="referencias" class="conteudo-form-label"></label>
                    <input type="text" placeholder="Referências" class="form-control" id="referencias" name="referencias">
                </div>
                <div class="mb-4">
                    <label for="imagem" class="conteudo-form-label">Adicionar Imagem</label>
                    <input type="file" class="form-control" id="imagem" name="imagem">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg mt-3">Salvar Notícia</button>
                </div>
            </form>
        </div>
        
        <!-- Tab Pane for Eventos -->
        <div class="tab-pane fade" id="evento-tab-pane" role="tabpanel" aria-labelledby="evento-tab" tabindex="0">
            <form action="cadastro_jornal.php" method="POST" enctype="multipart/form-data">
                <!-- Adiciona um campo oculto para identificar o formulário -->
                <input type="hidden" name="form_type" value="evento">
                <div class="mb-3">
                    <label for="nome_evento" class="conteudo-form-label">Nome do Evento</label>
                    <input type="text" class="form-control" id="nome_evento" name="nome_evento" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="data_inicio_evento" class="conteudo-form-label">Data de Início</label>
                        <input type="date" class="form-control" id="data_inicio_evento" name="data_inicio_evento" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="data_termino_evento" class="conteudo-form-label">Data de Término</label>
                        <input type="date" class="form-control" id="data_termino_evento" name="data_termino_evento">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="hora_evento" class="conteudo-form-label">Horário</label>
                    <input type="time" class="form-control" id="hora_evento" name="hora_evento" required>
                </div>
                <div class="mb-3">
                    <label for="local_evento" class="conteudo-form-label">Local</label>
                    <input type="text" class="form-control" id="local_evento" name="local_evento" required>
                </div>
                <div class="mb-3">
                    <label for="descricao_evento" class="conteudo-form-label">Descrição do Evento</label>
                    <textarea class="form-control" id="descricao_evento" name="descricao_evento" rows="6"></textarea>
                </div>
                <div class="mb-4">
                    <label for="imagem_evento" class="conteudo-form-label">Adicionar Imagem</label>
                    <input type="file" class="form-control" id="imagem_evento" name="imagem">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg mt-3">Salvar Evento</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Inclui o Bootstrap JS -->
</body>
</html>
