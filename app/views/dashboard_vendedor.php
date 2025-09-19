<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard da Loja</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap">
    <style>
        /* Estilos base (desktop-first) */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 40px 24px;
        }

        .main-heading {
            font-size: 3rem;
            font-weight: 800;
            text-align: center;
            color: #1a202c;
            margin-bottom: 40px;
        }

        .stats-grid,
        .activity-grid {
            display: grid;
            gap: 24px;
        }

        /* Define o grid padrão para telas maiores primeiro */
        .stats-grid {
            grid-template-columns: repeat(4, 1fr);
            margin-bottom: 48px;
        }

        .activity-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .card {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 24px;
            border: 1px solid #e2e8f0;
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .card-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: #4a5568;
        }

        .card-icon {
            height: 32px;
            width: 32px;
            flex-shrink: 0;
        }

        .card-value {
            font-size: 3rem;
            font-weight: 800;
            color: #1a202c;
        }

        .card-text {
            font-size: 0.875rem;
            color: #a0aec0;
            margin-top: 8px;
            display: block;
        }

        .icon-blue { color: #4299e1; }
        .icon-green { color: #48bb78; }
        .icon-yellow { color: #ecc94b; }
        .icon-red { color: #f56565; }

        .activity-card {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 24px;
            border: 1px solid #e2e8f0;
        }

        .activity-heading {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 24px;
        }

        .recent-table {
            width: 100%;
            border-collapse: collapse;
        }

        .recent-table th,
        .recent-table td {
            padding: 12px 24px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .recent-table th {
            background-color: #f7fafc;
            color: #4a5568;
            font-size: 0.875rem;
            text-transform: uppercase;
            font-weight: 600;
        }

        .recent-table tr:hover {
            background-color: #f7fafc;
            transition: background-color 0.2s ease-in-out;
        }

        .product-link {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .product-image {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 12px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .product-name {
            font-weight: 600;
            color: #4299e1;
            transition: color 0.2s;
        }

        .product-link:hover .product-name {
            text-decoration: underline;
        }

        .activity-info {
            color: #4a5568;
            font-size: 0.875rem;
        }

        .empty-state {
            text-align: center;
            color: #a0aec0;
            padding: 24px 0;
        }

        /* Media Queries para responsividade */
        @media (max-width: 1023px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 767px) {
            .main-heading {
                font-size: 2rem;
                margin-bottom: 24px;
            }
            .stats-grid {
                grid-template-columns: repeat(1, 1fr);
                gap: 16px;
            }
            .activity-grid {
                grid-template-columns: repeat(1, 1fr);
            }
            .card {
                padding: 16px;
            }
            .card-icon {
                height: 24px;
                width: 24px;
            }
            .card-value {
                font-size: 1.5rem;
            }
            .dashboard-container {
                padding: 20px 16px;
            }

            /* Responsividade para a Tabela */
            .recent-table {
                border-collapse: separate;
                border-spacing: 0 12px;
            }
            .recent-table thead {
                display: none;
            }

            .recent-table tr {
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                display: block;
                margin-bottom: 16px;
                padding: 12px;
            }

            .recent-table td {
                display: flex;
                flex-direction: column;
                padding: 8px 0;
                border-bottom: none;
                box-sizing: border-box;
            }

            .recent-table td:before {
                font-weight: bold;
                content: attr(data-label);
                display: block;
                margin-bottom: 4px;
                color: #4a5568;
                text-transform: uppercase;
                font-size: 0.75rem;
            }

            .product-link {
                flex-direction: row;
            }

            .product-image {
                width: 48px;
                height: 48px;
            }

            .activity-info {
                font-size: 1rem;
                color: #1a202c;
                font-weight: 500;
            }

            .product-name {
                font-size: 1rem;
            }
        }

        @media (min-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .activity-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
    </style>
</head>
<body class="antialiased">
    <div class="dashboard-container">
        <h1 class="main-heading">Dashboard da Loja</h1>

        <div class="stats-grid">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Produtos Totais</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="card-icon icon-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                </div>
                <h2 class="card-value"><?php echo htmlspecialchars($total_produtos); ?></h2>
                <span class="card-text">Na sua loja</span>
            </div>

            <div class="card">
                <div class="card-header">
                    <span class="card-title">Disponíveis</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="card-icon icon-green" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 11-5.93-8.62"></path>
                        <path d="M22 4L12 14.01l-3-3"></path>
                    </svg>
                </div>
                <h2 class="card-value"><?php echo htmlspecialchars($produtos_disponiveis); ?></h2>
                <span class="card-text">Prontos para venda</span>
            </div>

            <div class="card">
                <div class="card-header">
                    <span class="card-title">Reservados</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="card-icon icon-yellow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <h2 class="card-value"><?php echo htmlspecialchars($produtos_reservados); ?></h2>
                <span class="card-text">Aguardando confirmação</span>
            </div>

            <a href="produtos_finalizados.php" style="text-decoration: none; color: inherit;">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Vendidos</span>

                        <svg xmlns="http://www.w3.org/2000/svg" class="card-icon icon-red" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <path d="M17 11l5-5-5-5"></path>
                            <path d="M22 6h-7"></path>
                        </svg>
                    </div>
                    <h2 class="card-value"><?php echo htmlspecialchars($produtos_vendidos); ?></h2>
                    <span class="card-text">Itens vendidos</span>
                </div>
            </a>
        </div>

        <div class="activity-grid">
            <div class="activity-card">
                <h3 class="activity-heading">Últimas Reservas</h3>
                <?php if (!empty($produtos_reservados_recentes)): ?>
                    <table class="recent-table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Comprador</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produtos_reservados_recentes as $reserva): ?>
                            <tr data-row>
                                <td data-label="Produto:">
                                    <a href="ver_produto.php?id=<?php echo htmlspecialchars($reserva['id']); ?>" class="product-link">
                                        <?php
                                        // O caminho da imagem deve ser manipulado aqui, se necessário
                                        $imagens = !empty($reserva['imagem']) ? unserialize($reserva['imagem']) : null;
                                        $primeira_imagem = !empty($imagens) ? $imagens[0] : 'https://placehold.co/40x40/e2e8f0/a0aec0?text=IMG';
                                        ?>
                                        <img src="../public/uploads/<?php echo htmlspecialchars($primeira_imagem); ?>" alt="Imagem do Produto" class="product-image">
                                        <span class="product-name"><?php echo htmlspecialchars($reserva['produto_nome']); ?></span>
                                    </a>
                                </td>
                                <td data-label="Comprador:" class="activity-info"><?php echo htmlspecialchars($reserva['comprador_nome']); ?></td>
                                <td data-label="Data:" class="activity-info"><?php echo date('d/m/Y', strtotime($reserva['data_cadastro'])); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                <p class="empty-state">Nenhuma reserva recente encontrada.</p>
                <?php endif; ?>
            </div>

            <div class="activity-card">
                <h3 class="activity-heading">Últimas Vendas</h3>
                <?php if (!empty($vendas_recentes)): ?>
                    <table class="recent-table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Comprador</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vendas_recentes as $venda): ?>
                            <tr data-row>
                                <td data-label="Produto:">
                                    <a href="ver_produto.php?id=<?php echo htmlspecialchars($venda['id']); ?>" class="product-link">
                                        <?php
                                        $imagens = !empty($venda['imagem']) ? unserialize($venda['imagem']) : null;
                                        $primeira_imagem = !empty($imagens) ? $imagens[0] : 'https://placehold.co/40x40/e2e8f0/a0aec0?text=IMG';
                                        ?>
                                        <img src="../public/uploads/<?php echo htmlspecialchars($primeira_imagem); ?>" alt="Imagem do Produto" class="product-image">
                                        <span class="product-name"><?php echo htmlspecialchars($venda['produto_nome']); ?></span>
                                    </a>
                                </td>
                                <td data-label="Comprador:" class="activity-info"><?php echo htmlspecialchars($venda['comprador_nome']); ?></td>
                                <td data-label="Data:" class="activity-info"><?php echo date('d/m/Y', strtotime($venda['data_venda'])); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                <p class="empty-state">Nenhuma venda recente encontrada.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>