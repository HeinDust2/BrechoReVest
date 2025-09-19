<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil da Loja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #0d6efd;
            --success-color: #198754;
            --danger-color: #dc3545;
            --background-color: #f0f2f5;
            --card-bg-color: #ffffff;
            --text-color-primary: #212529;
            --text-color-secondary: #6c757d;
            --border-color: #e9ecef;
        }

        body {
            background-color: var(--background-color);
            font-family: 'Poppins', sans-serif;
            color: var(--text-color-primary);
        }

        .profile-card {
            background-color: var(--card-bg-color);
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
            padding: 2.5rem 0;
            background-color: #f8f9fa;
            border-top-left-radius: 1.5rem;
            border-top-right-radius: 1.5rem;
        }
        
        @media (min-width: 992px) {
            .profile-header {
                padding: 2.5rem 0;
                border-top-left-radius: 1.5rem;
                border-top-right-radius: 0;
                border-bottom-left-radius: 1.5rem;
            }
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #495057;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--border-color);
            margin-bottom: 1.5rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-color);
        }
        
        .contact-item:last-child {
            border-bottom: none;
        }

        .contact-item i {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .contact-item strong {
            font-weight: 500;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .social-link {
            transition: all 0.3s ease;
            color: var(--text-color-secondary);
        }

        .social-link i {
            font-size: 2.5rem;
        }

        .social-link:hover {
            color: var(--primary-color);
            transform: scale(1.1);
        }

        .btn-action {
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-whatsapp {
            background-color: var(--success-color);
            border-color: var(--success-color);
            color: #fff;
        }

        .btn-whatsapp:hover {
            background-color: #157347;
            border-color: #157347;
        }

        .btn-reportar {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
            color: #fff;
        }

        .btn-reportar:hover {
            background-color: #bb2d3b;
            border-color: #bb2d3b;
        }
        
        /* Estilos do modal */
        .modal-header .btn-close {
            background-image: none;
        }

        .modal-content {
            border-radius: 1rem;
        }

        /* ---------------------------------------------------- */
        /* ---- Nova seção para visualização em Desktop ---- */
        /* ---------------------------------------------------- */
        @media (min-width: 992px) {
            .profile-card {
                display: flex;
                height: 90vh;
                overflow: hidden;
                max-width: 1200px;
                margin: auto;
            }

            .profile-header {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                width: 35%;
                padding: 2rem;
            }

            .profile-content {
                width: 65%;
                padding: 3rem;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                overflow-y: auto;
            }

            .profile-card .d-flex {
                display: flex !important;
                flex-direction: column;
                height: 100%;
            }

            .profile-card .row {
                width: 100%;
                margin: 0;
            }

            .profile-card .col-12 {
                padding: 0;
            }

            .contact-item p {
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body>
    
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-12">

                <div class="profile-card">
                    
                    <div class="profile-header">
                        <?php
                            $caminho_foto = '';
                            if (isset($loja['foto_perfil']) && !empty($loja['foto_perfil'])) {
                                $caminho_foto = '../public/uploads/' . htmlspecialchars($loja['foto_perfil']);
                            } else {
                                $caminho_foto = 'https://placehold.co/150x150/e9ecef/6c757d?text=Foto';
                            }
                        ?>
                        <img 
                            src="<?= $caminho_foto ?>" 
                            alt="Foto de perfil de <?= htmlspecialchars($loja['nome'] ?? 'Loja') ?>" 
                            class="profile-photo"
                        >
                        <h2 class="mt-4 mb-1 fs-3 fw-bold text-dark"><?= htmlspecialchars($loja['nome'] ?? 'Nome da Loja') ?></h2>
                        <p class="text-secondary mb-0"><?= htmlspecialchars($loja['bairro'] ?? 'Bairro não informado') ?></p>
                        <div class="mt-4 w-100 px-4">
                            <h5 class="section-title text-center">Sobre a Loja</h5>
                            <p class="text-muted text-center mb-0">
                                <?= htmlspecialchars($loja['biografia'] ?? 'Nenhuma biografia fornecida.') ?>
                            </p>
                        </div>
                    </div>

                    <div class="p-4 p-md-5 profile-content">
                        
                        <div class="mb-5">
                            <h5 class="section-title">Informações de Contato</h5>
                            <ul class="list-unstyled">
                                <li class="contact-item">
                                    <i class="bi bi-envelope"></i>
                                    <div>
                                        <strong>Email:</strong> <span><?= htmlspecialchars($loja['email'] ?? 'Não informado') ?></span>
                                    </div>
                                </li>
                                <li class="contact-item">
                                    <i class="bi bi-phone"></i>
                                    <div>
                                        <strong>Telefone:</strong> <span><?= htmlspecialchars($loja['telefone'] ?? 'Não informado') ?></span>
                                    </div>
                                </li>
                                <li class="contact-item">
                                    <i class="bi bi-geo-alt"></i>
                                    <div>
                                        <strong>Endereço:</strong>
                                        <p class="mb-0 text-muted">
                                            <?php
                                            $endereco = [];
                                            if (!empty($loja['rua'])) $endereco[] = htmlspecialchars($loja['rua']);
                                            if (!empty($loja['numero'])) $endereco[] = 'Nº ' . htmlspecialchars($loja['numero']);
                                            if (!empty($loja['complemento'])) $endereco[] = htmlspecialchars($loja['complemento']);
                                            if (!empty($loja['bairro'])) $endereco[] = htmlspecialchars($loja['bairro']);
                                            if (!empty($loja['cidade'])) $endereco[] = htmlspecialchars($loja['cidade']);
                                            if (!empty($loja['estado'])) $endereco[] = htmlspecialchars($loja['estado']);
                                            
                                            if (!empty($endereco)) {
                                                echo implode(', ', $endereco);
                                            } else {
                                                echo 'Não informado';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </li>
                                <li class="contact-item">
                                    <i class="bi bi-map"></i>
                                    <div>
                                        <strong>CEP:</strong> <span><?= htmlspecialchars($loja['cep'] ?? 'Não informado') ?></span>
                                    </div>
                                </li>
                            </ul>
                            <?php if (!empty($loja['telefone']) && !empty($telefone_whatsapp_loja)): ?>
                                <a href="https://wa.me/<?= $telefone_whatsapp_loja ?>" target="_blank" class="btn btn-whatsapp w-100 btn-action mt-4">
                                    <i class="bi bi-whatsapp me-2"></i> Enviar Mensagem via WhatsApp
                                </a>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-5">
                            <h5 class="section-title text-center">Redes Sociais</h5>
                            <div class="social-links">
                                <?php
                                $has_social_links = false;
                                $social_links = [
                                    'facebook' => $loja['facebook'] ?? '',
                                    'instagram' => $loja['instagram'] ?? '',
                                    'twitter' => $loja['twitter'] ?? '',
                                    'tiktok' => $loja['tiktok'] ?? '',
                                    'whatsapp' => $loja['whatsapp'] ?? '',
                                ];
                                foreach ($social_links as $platform => $url) {
                                    if (!empty($url) && filter_var($url, FILTER_VALIDATE_URL)) {
                                        $has_social_links = true;
                                        $icon_class = '';
                                        switch ($platform) {
                                            case 'facebook': $icon_class = 'bi-facebook'; break;
                                            case 'instagram': $icon_class = 'bi-instagram'; break;
                                            case 'twitter': $icon_class = 'bi-twitter-x'; break;
                                            case 'tiktok': $icon_class = 'bi-tiktok'; break;
                                            case 'whatsapp': $icon_class = 'bi-whatsapp'; break;
                                        }
                                        echo '<a href="' . htmlspecialchars($url) . '" target="_blank" class="social-link">';
                                        echo '<i class="bi ' . $icon_class . '"></i>';
                                        echo '</a>';
                                    }
                                }
                                if (!$has_social_links): ?>
                                    <p class="text-muted text-center w-100 mb-0">Nenhuma rede social informada.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="d-grid gap-3 mt-5">
                            <a href="listar_produtos.php" class="btn btn-outline-secondary btn-action">
                                <i class="bi bi-arrow-left me-2"></i> Voltar à Lista de Produtos
                            </a>
                            <button type="button" class="btn btn-reportar btn-action" data-bs-toggle="modal" data-bs-target="#reportModal">
                                <i class="bi bi-flag-fill me-2"></i> Reportar Loja
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="reportModalLabel">Denúncia Recebida</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center py-5">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
            <h4 class="mt-3">Loja reportada com sucesso!</h4>
            <p class="text-muted mt-2">Agradecemos sua ajuda para manter nossa plataforma segura. Nossa equipe analisará a denúncia em breve.</p>
          </div>
          <div class="modal-footer d-flex justify-content-center">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
          </div>
        </div>
      </div>
    </div>

</body>
</html>