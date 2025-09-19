<?php
// Inicia a sessão se ainda não estiver ativa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclui a conexão com o banco de dados
include __DIR__ . '/../core/conexao.php';

// Inclui a biblioteca Imagine
require_once __DIR__ . '/../../vendor/autoload.php';
use Imagine\Gd\Imagine;
use Imagine\Image\Box;

$imagine = new Imagine();

// Define o caminho para o diretório de uploads
$caminho_uploads = __DIR__ . '/../../public/uploads/';
if (!is_dir($caminho_uploads)) {
    mkdir($caminho_uploads, 0777, true);
}

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensagem'] = "Você precisa estar logado para gerenciar produtos.";
    $_SESSION['tipo_mensagem'] = "warning";
    header('Location: autenticacao.php?acao=login');
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];
$telefone_usuario = $_SESSION['usuario']['telefone'] ?? '';
$produto = null;
$titulo = "Adicionar Novo Produto";
$mensagem = '';
$tipo_mensagem = '';

// Carrega produto para edição, se ID fornecido
if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];
    $titulo = "Editar Produto";
    $sql = "SELECT * FROM produtos WHERE id = ? AND usuario_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $produto_id, $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $produto = $resultado->fetch_assoc();
        $produto['pagamento'] = !empty($produto['pagamento']) ? unserialize($produto['pagamento']) : [];
        $produto['imagem'] = !empty($produto['imagem']) ? unserialize($produto['imagem']) : [];
    } else {
        $_SESSION['mensagem'] = "Produto não encontrado ou você não tem permissão para editá-lo.";
        $_SESSION['tipo_mensagem'] = "danger";
        header('Location: meus_produtos.php');
        exit();
    }
}

// Processa o formulário de salvar/atualizar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $nome = htmlspecialchars(trim($_POST['nome']));
    $descricao = htmlspecialchars(trim($_POST['descricao'] ?? ''));
    $preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);
    $tamanho = htmlspecialchars(trim($_POST['tamanho']));
    $tipo_roupa = htmlspecialchars(trim($_POST['tipo_roupa'] ?? ''));
    $estilo = htmlspecialchars(trim($_POST['estilo'] ?? ''));
    $cor = htmlspecialchars(trim($_POST['cor']));
    $materiais = htmlspecialchars(trim($_POST['materiais'] ?? ''));
    $pagamento = $_POST['pagamento'] ?? [];
    $telefone = $telefone_usuario;

    if (empty($nome) || $preco === false || empty($tamanho) || empty($cor) || empty($pagamento)) {
        $mensagem = "Por favor, preencha todos os campos obrigatórios (Nome, Preço, Tamanho, Cor e pelo menos uma forma de Pagamento).";
        $tipo_mensagem = "danger";
    } else {
        $pagamento_serializado = serialize($pagamento);

        // Imagens existentes
        $imagens_existentes = ($produto && !empty($produto['imagem'])) ? $produto['imagem'] : [];
        $imagens_para_excluir = $_POST['excluir_imagens'] ?? [];

        // Exclui imagens marcadas
        if ($id && !empty($imagens_para_excluir)) {
            foreach ($imagens_para_excluir as $imagem_nome) {
                $caminho_imagem = $caminho_uploads . $imagem_nome;
                if (file_exists($caminho_imagem)) {
                    unlink($caminho_imagem);
                    $imagens_existentes = array_diff($imagens_existentes, [$imagem_nome]);
                }
            }
        }

        // Upload de imagens usando Imagine
        $imagens_finais = $imagens_existentes;
        if (!empty($_FILES['imagens']['name'][0])) {
            foreach ($_FILES['imagens']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['imagens']['error'][$key] === UPLOAD_ERR_OK) {
                    $originalName = basename($_FILES['imagens']['name'][$key]);
                    $destino = $caminho_uploads . $originalName;

                    try {
                        $image = $imagine->open($tmp_name);

                        // Ajuste automático da orientação
                        if (function_exists('exif_read_data')) {
                            $exif = @exif_read_data($tmp_name);
                            if ($exif && isset($exif['Orientation'])) {
                                switch ($exif['Orientation']) {
                                    case 3: $image->rotate(180); break;
                                    case 6: $image->rotate(90); break;
                                    case 8: $image->rotate(-90); break;
                                }
                            }
                        }

                        // Redimensiona mantendo proporção máxima 800x800
                        $size = $image->getSize();
                        $ratio = $size->getWidth() / $size->getHeight();

                        if ($ratio > 1) {
                            $width = 800;
                            $height = intval(800 / $ratio);
                        } else {
                            $height = 800;
                            $width = intval(800 * $ratio);
                        }

                        $image->resize(new Box($width, $height))
                              ->save($destino, ['quality' => 90]);

                        $imagens_finais[] = $originalName;

                    } catch (\Exception $e) {
                        $mensagem = "Erro ao processar imagem {$originalName}: " . $e->getMessage();
                        $tipo_mensagem = "danger";
                    }
                }
            }
        }

        if (!$id && empty($imagens_finais)) {
            $mensagem = "É necessário enviar pelo menos uma imagem para o novo produto.";
            $tipo_mensagem = "danger";
        }

        $imagens_finais_serializadas = serialize($imagens_finais);

        if (empty($mensagem)) {
            if ($id) {
                // Atualiza produto
                $sql = "UPDATE produtos SET nome=?, descricao=?, preco=?, tamanho=?, tipo_roupa=?, estilo=?, cor=?, materiais=?, telefone=?, pagamento=?, imagem=? WHERE id=? AND usuario_id=?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param(
                    "ssdssssssssii",
                    $nome, $descricao, $preco, $tamanho, $tipo_roupa, $estilo, $cor, $materiais, $telefone, $pagamento_serializado, $imagens_finais_serializadas, $id, $usuario_id
                );

                if ($stmt->execute()) {
                    $_SESSION['mensagem'] = "Produto atualizado com sucesso!";
                    $_SESSION['tipo_mensagem'] = "success";
                    header('Location: meus_produtos.php');
                    exit();
                } else {
                    $mensagem = "Erro ao atualizar o produto: " . $con->error;
                    $tipo_mensagem = "danger";
                }
            } else {
                // Insere novo produto
                $sql = "INSERT INTO produtos (nome, descricao, preco, tamanho, tipo_roupa, estilo, cor, materiais, telefone, pagamento, imagem, usuario_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $con->prepare($sql);
                $stmt->bind_param(
                    "ssdssssssssi",
                    $nome, $descricao, $preco, $tamanho, $tipo_roupa, $estilo, $cor, $materiais, $telefone, $pagamento_serializado, $imagens_finais_serializadas, $usuario_id
                );

                if ($stmt->execute()) {
                    $_SESSION['mensagem'] = "Produto cadastrado com sucesso!";
                    $_SESSION['tipo_mensagem'] = "success";
                    header('Location: meus_produtos.php');
                    exit();
                } else {
                    $mensagem = "Erro ao cadastrar o produto: " . $con->error;
                    $tipo_mensagem = "danger";
                }
            }
        }
    }
}

// Inclui o header
include __DIR__ . '/../includes/header.php';
?>

