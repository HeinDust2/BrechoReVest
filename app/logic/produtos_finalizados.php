<?php
// Inicia a sessão se ainda não estiver ativa.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclui o cabeçalho e a conexão com o banco de dados
include __DIR__ . '/../core/conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensagem'] = "Você precisa estar logado para acessar seus produtos.";
    $_SESSION['tipo_mensagem'] = "warning";
    header('Location: autenticacao.php?acao=login');
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];

// SQL para listar apenas os produtos com o status 'vendido'
$sql = "
    SELECT 
        p.id, p.nome, p.preco, p.imagem, p.status_reserva, p.comprador_id,
        u_vendedor.nome AS nome_reservador, u_vendedor.telefone AS telefone_reservador,
        u_comprador.nome AS nome_comprador, u_comprador.telefone AS telefone_comprador
    FROM 
        produtos p
    LEFT JOIN 
        usuarios u_vendedor ON p.usuario_id = u_vendedor.id
    LEFT JOIN 
        usuarios u_comprador ON p.comprador_id = u_comprador.id
    WHERE 
        p.usuario_id = ? AND p.status_reserva = 'vendido'
    ORDER BY 
        p.data_cadastro DESC";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

include __DIR__ . '/../includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produtos Vendidos</title>

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
    <h2 class="text-primary fw-semibold"><i class="bi bi-tag-fill me-2"></i>Produtos Vendidos</h2>
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
              <span class="badge bg-dark position-absolute top-0 start-0 m-2">
                <i class="bi bi-tag-fill me-1"></i> Vendido
              </span>
            </div>

            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-primary fw-semibold"><?= htmlspecialchars($produto['nome']) ?></h5>
              <p class="card-text text-success fs-5 fw-bold">R$ <?= htmlspecialchars(number_format($produto['preco'], 2, ',', '.')) ?></p>
              
              <?php if (!empty($produto['nome_comprador'])): ?>
                <small class="text-muted mt-auto">Comprador: <?= htmlspecialchars($produto['nome_comprador']) ?></small>
              <?php endif; ?>
            </div>

            <div class="card-footer bg-white border-0 text-center">
              <a class="btn btn-outline-success rounded-pill w-100" href="https://wa.me/<?= htmlspecialchars(preg_replace('/[^0-9]/', '', $produto['telefone_comprador'])) ?>" target="_blank">
                <i class="bi bi-whatsapp me-1"></i> Contatar Comprador
              </a>
            </div>
          </div>
        </div>

      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <div class="empty-state">
      <i class="bi bi-bag-check fs-1 text-primary mb-3"></i>
      <h3>Você ainda não marcou nenhum produto como vendido.</h3>
      <p class="text-muted">Comece a vender e seus produtos aparecerão aqui!</p>
    </div>
  <?php endif; ?>
</main>

</body>
</html>