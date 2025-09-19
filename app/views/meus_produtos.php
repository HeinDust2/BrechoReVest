<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meus Produtos</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }
    .btn-primary {
      background-color: #5AA4FA;
      border-color: #5AA4FA;
    }
    .btn-primary:hover {
      background-color: #4992e0;
      border-color: #4992e0;
    }
    .card {
      border: none;
      border-radius: 3.25rem;
      box-shadow: 0 5px 15px rgba(0,0,0,0.08);
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    .card-img-top {
      height: 220px;
      object-fit: cover;
      border-top-left-radius: 1.25rem;
      border-top-right-radius: 1.25rem;
    }
    .badge {
      font-size: 0.8rem;
      padding: 0.35rem 0.65rem;
      border-radius: 0.75rem;
    }
    .empty-state {
      text-align: center;
      margin-top: 5rem;
      padding: 2.5rem;
      border-radius: 1.25rem;
      background: #fff;
      box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    .modal-content {
      border-radius: 1rem;
    }
    @media (max-width: 575.98px) {
      .card-img-top { height: 150px; }
    }
  </style>
</head>
<body>
<main class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary fw-semibold"><i class="bi bi-box-seam me-2"></i>Meus Produtos</h2>
    <a href="gerenciar_produto.php" class="btn btn-primary rounded-pill d-flex align-items-center">
      <i class="bi bi-plus-circle me-2"></i> Adicionar Novo
    </a>
  </div>

  <?php if (isset($_SESSION['mensagem'])): ?>
    <div class="alert alert-<?= $_SESSION['tipo_mensagem'] ?> alert-dismissible fade show rounded-4" role="alert">
      <?= htmlspecialchars($_SESSION['mensagem']) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']); ?>
  <?php endif; ?>

  <?php if ($resultado->num_rows > 0): ?>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4">
      <?php while ($produto = $resultado->fetch_assoc()):
        $imagens = !empty($produto['imagem']) ? unserialize($produto['imagem']) : [];
        $imagem_preview = (!empty($imagens) && is_array($imagens) && file_exists('uploads/' . $imagens[0])) ? 'uploads/' . $imagens[0] : 'imagens/placeholder.png';
      ?>
        <div class="col">
          <div class="card h-100">
            <div class="position-relative">
              <a href="ver_produto.php?id=<?= htmlspecialchars($produto['id']) ?>" class="stretched-link"></a>
              <img src="<?= htmlspecialchars($imagem_preview) ?>" class="card-img-top" alt="<?= htmlspecialchars($produto['nome']) ?>">
              
              <?php if ($produto['status_reserva'] === 'reservado'): ?>
                <span class="badge bg-success position-absolute top-0 start-0 m-2">
                  <i class="bi bi-check-circle me-1"></i> Reservado
                </span>
              <?php elseif ($produto['status_reserva'] === 'vendido'): ?>
                <span class="badge bg-dark position-absolute top-0 start-0 m-2">
                  <i class="bi bi-tag-fill me-1"></i> Vendido
                </span>
              <?php else: ?>
                <span class="badge bg-primary position-absolute top-0 start-0 m-2">
                  <i class="bi bi-box me-1"></i> Disponível
                </span>
              <?php endif; ?>
            </div>

            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-primary fw-semibold"><?= htmlspecialchars($produto['nome']) ?></h5>
              <p class="card-text text-success fs-5 fw-bold">R$ <?= htmlspecialchars(number_format($produto['preco'], 2, ',', '.')) ?></p>
              
              <?php if ($produto['status_reserva'] === 'reservado' && !empty($produto['nome_comprador'])): ?>
                <small class="text-muted mt-auto">Por: <?= htmlspecialchars($produto['nome_comprador']) ?></small>
              <?php endif; ?>
            </div>

            <!-- Botão abre modal de opções -->
            <div class="card-footer bg-white border-0 text-center">
              <button class="btn btn-outline-primary rounded-pill w-100" data-bs-toggle="modal" data-bs-target="#opcoesModal<?= $produto['id'] ?>">
                Opções
              </button>
            </div>
          </div>
        </div>

        <!-- Modal de Opções -->
        <div class="modal fade" id="opcoesModal<?= $produto['id'] ?>" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header border-0">
                <h5 class="modal-title">Opções - <?= htmlspecialchars($produto['nome']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body text-center">
                <?php if ($produto['status_reserva'] === 'disponivel'): ?>
                  <a class="btn btn-outline-primary rounded-pill w-100 mb-2" href="gerenciar_produto.php?id=<?= $produto['id'] ?>">
                    <i class="bi bi-pencil-square me-1"></i> Editar
                  </a>
                  <a class="btn btn-outline-danger rounded-pill w-100 mb-2" href="#" data-modal="#deleteModal<?= $produto['id'] ?>">
                    <i class="bi bi-trash me-1"></i> Excluir
                  </a>
                <?php elseif ($produto['status_reserva'] === 'reservado'): ?>
                  <a class="btn btn-outline-success rounded-pill w-100 mb-2" href="https://wa.me/<?= htmlspecialchars(preg_replace('/[^0-9]/', '', $produto['telefone_comprador'])) ?>" target="_blank">
                    <i class="bi bi-whatsapp me-1"></i> Contatar Comprador
                  </a>
                  <a class="btn btn-outline-dark rounded-pill w-100 mb-2" href="#" data-modal="#confirmVendaModal<?= $produto['id'] ?>">
                    <i class="bi bi-check2-circle me-1"></i> Marcar como Vendido
                  </a>
                  <a class="btn btn-outline-secondary rounded-pill w-100 mb-2" href="#" data-modal="#cancelarReservaModal<?= $produto['id'] ?>">
                    <i class="bi bi-x-circle me-1"></i> Cancelar Reserva
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Modais de Confirmação (já existiam) -->
        <div class="modal fade" id="deleteModal<?= $produto['id'] ?>" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
              <div class="modal-body">
                <i class="bi bi-trash-fill text-danger" style="font-size:3rem;"></i>
                <h5 class="mt-3">Confirmar Exclusão</h5>
                <p>Deseja excluir o produto <strong><?= htmlspecialchars($produto['nome']) ?></strong>? Essa ação é irreversível.</p>
              </div>
              <div class="modal-footer border-0 justify-content-center">
                <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                <a href="acoes_produto.php?acao=excluir&id=<?= $produto['id'] ?>" class="btn btn-danger rounded-pill">Sim, Excluir</a>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="confirmVendaModal<?= $produto['id'] ?>" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
              <div class="modal-body">
                <i class="bi bi-currency-dollar text-dark" style="font-size:3rem;"></i>
                <h5 class="mt-3">Confirmar Venda</h5>
                <p>Deseja marcar o produto <strong><?= htmlspecialchars($produto['nome']) ?></strong> como vendido?</p>
              </div>
              <div class="modal-footer border-0 justify-content-center">
                <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                <a href="acoes_produto.php?acao=vender&id=<?= $produto['id'] ?>" class="btn btn-dark rounded-pill">Sim, Vender</a>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="cancelarReservaModal<?= $produto['id'] ?>" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
              <div class="modal-body">
                <i class="bi bi-x-circle-fill text-secondary" style="font-size:3rem;"></i>
                <h5 class="mt-3">Cancelar Reserva</h5>
                <p>Deseja cancelar a reserva do produto <strong><?= htmlspecialchars($produto['nome']) ?></strong>?</p>
              </div>
              <div class="modal-footer border-0 justify-content-center">
                <button class="btn btn-primary rounded-pill" data-bs-dismiss="modal">Não, Manter</button>
                <a href="acoes_produto.php?acao=cancelar_reserva&id=<?= $produto['id'] ?>" class="btn btn-secondary rounded-pill">Sim, Cancelar</a>
              </div>
            </div>
          </div>
        </div>

      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <div class="empty-state">
      <i class="bi bi-box-seam-fill fs-1 text-primary mb-3"></i>
      <h3>Você ainda não possui nenhum produto cadastrado.</h3>
      <p class="text-muted">Clique abaixo para adicionar seu primeiro item!</p>
      <a href="gerenciar_produto.php" class="btn btn-lg btn-primary rounded-pill mt-3">
        <i class="bi bi-plus-circle me-2"></i> Adicionar Novo Produto
      </a>
    </div>
  <?php endif; ?>
</main>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modalLinks = document.querySelectorAll('a[data-modal]');
    modalLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const modalId = this.getAttribute('data-modal');
        const modalElement = document.querySelector(modalId);
        if (modalElement) {
          new bootstrap.Modal(modalElement).show();
        }
      });
    });
  });
</script>
</body>
</html>
