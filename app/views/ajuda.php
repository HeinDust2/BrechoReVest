<?php
include __DIR__ . '/../includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Ajuda</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="bg-light text-dark">

    <div class="container my-5">

        <header class="text-center py-5">
            <h1 class="display-4 fw-bolder text-primary mb-2">Central de Ajuda</h1>
            <p class="h5 text-secondary fw-light">Tire suas dúvidas e aprenda a usar a plataforma.</p>
        </header>

        <main class="row g-4">

            <section class="col-md-8">
                <div class="bg-white rounded-4 shadow p-4">
                    <h2 class="h3 fw-bold text-dark mb-4">Perguntas Frequentes</h2>
                    
                    <div class="accordion" id="faqAccordion">

                        <div class="accordion-item rounded-4 mb-3">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <i class="fas fa-user-plus me-2 text-success"></i> 1. Cadastro e Login
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>
                                        Você pode criar uma conta e usá-la tanto para reservar itens como comprador quanto para anunciar produtos como vendedor.
                                    </p>
                                    <p>
                                        Voce também pode ver catálogo de produtos disponíveis sem está logado, mas você vai precisar logar caso queria reservar ou anunciar algo, clique no botão abaixo.
                                    </p>
                                    <a href="listar_produtos.php" class="btn btn-primary fw-semibold shadow-sm">
                                        <i class="fas fa-search me-1"></i> Listar Produtos
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item rounded-4 mb-3">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-shopping-cart me-2 text-primary"></i> 2. Como Reservar um Item
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>
                                        Ao reservar um item, você pode ir para a página do seu carrinho para entrar em contato com o vendedor e negociar o produto ou cancelar a reserva.
                                    </p>
                                    <a href="minhas_reservas.php" class="btn btn-primary fw-semibold shadow-sm">
                                        <i class="fas fa-box-open me-1"></i> Minhas Reservas
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item rounded-4 mb-3">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fas fa-bullhorn me-2 text-info"></i> 3. Anunciando seus Produtos
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>
                                        Para anunciar suas peças, use o botão abaixo. Preencha todas as informações corretamente; elas devem sair do vermelho e ficar verdes para que o anúncio seja concluído.
                                    </p>
                                    <a href="gerenciar_produto.php" class="btn btn-success fw-semibold shadow-sm mb-3">
                                        <i class="fas fa-plus me-1"></i> Anunciar Produto
                                    </a>
                                    <p>
                                        Depois de anunciar, você pode ir para **"Meus Anúncios"** para acompanhar o status de seus produtos.
                                    </p>
                                    <a href="meus_produtos.php" class="btn btn-secondary fw-semibold shadow-sm">
                                        <i class="fas fa-clipboard-list me-1"></i> Meus Anúncios
                                    </a>
                                    <h5 class="mt-4 mb-2">Status do Anúncio:</h5>
                                    <ul>
                                        <li>**Disponível:** Se ninguém reservou, o status estará como "Disponível". Você pode editar ou excluir o anúncio.</li>
                                        <li>**Reservado:** Se já estiver reservado, a opção para contatar o comprador aparecerá. Você também pode marcar como vendido (caso a negociação seja concluída) ou cancelar a reserva para que o produto volte a ficar disponível para outros usuários.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item rounded-4 mb-3">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <i class="fas fa-user-cog me-2 text-secondary"></i> 4. Painel Geral do Usuário
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p>
                                        Ao clicar nas três linhas (menu hambúrguer) ou na sua foto de perfil, você terá acesso ao painel geral.
                                    </p>
                                    <a href="dashboard_vendedor.php" class="btn btn-warning text-dark fw-semibold shadow-sm mb-3">
                                        <i class="fas fa-chart-line me-1"></i> Dashboard do Vendedor
                                    </a>
                                    <h5 class="mt-4 mb-2">Opções do Menu:</h5>
                                    <ul>
                                        <li>**Editar Perfil:** Para alterar suas informações de usuário.</li>
                                        <li>**Sair:** Para deslogar sua conta.</li>
                                        <li>**Acessibilidade:** Para tornar os elementos da página mais visíveis e fáceis de ler.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="col-md-4">
                <div class="bg-white rounded-4 shadow p-4">
                    <h2 class="h3 fw-bold text-dark mb-4">Navegação Rápida</h2>
                    <div class="d-flex flex-column gap-3">
                        <a href="#headingOne" class="btn btn-light text-start py-3 fw-semibold">
                            <i class="fas fa-user-plus me-2 text-success"></i> Cadastro e Login
                        </a>
                        <a href="#headingTwo" class="btn btn-light text-start py-3 fw-semibold">
                            <i class="fas fa-shopping-cart me-2 text-primary"></i> Como Reservar um Item
                        </a>
                        <a href="#headingThree" class="btn btn-light text-start py-3 fw-semibold">
                            <i class="fas fa-bullhorn me-2 text-info"></i> Anunciando Produtos
                        </a>
                        <a href="#headingFour" class="btn btn-light text-start py-3 fw-semibold">
                            <i class="fas fa-user-cog me-2 text-secondary"></i> Painel Geral do Usuário
                        </a>
                    </div>
                </div>
            </section>
        </main>

        <footer class="text-center py-5 mt-4 bg-white rounded-4 shadow p-4">
            <h3 class="h4 fw-bold text-dark mb-2">Ainda precisa de ajuda?</h3>
            <p class="text-dark mb-3">Envie-nos uma mensagem e nossa equipe irá te ajudar!</p>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                <input type="email" placeholder="Seu e-mail" class="form-control rounded-3 border flex-grow-1" style="max-width: 300px;">
                <button class="btn btn-primary rounded-3 fw-semibold shadow">Enviar Mensagem</button>
            </div>
        </footer>

    </div>


</body>
</html>