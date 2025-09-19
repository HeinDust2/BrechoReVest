<?php
// Inicia a sessão se ainda não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Conexão com o banco de dados. Certifique-se de que o caminho está correto.
require_once __DIR__ . '/../core/conexao.php';

// 1. Verifica se o formulário foi submetido via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 2. Recebe o tipo de formulário enviado (notícia ou evento)
    $form_type = isset($_POST['form_type']) ? $_POST['form_type'] : null;

    // 3. Processa o formulário de notícias
    if ($form_type === 'noticia') {
        
        // --- INÍCIO DA MUDANÇA: Vincular autor ao usuário logado ---
        // Obtém o nome do usuário logado da sessão, usando a chave correta
        if (isset($_SESSION['usuario']['nome'])) {
            $autor = $_SESSION['usuario']['nome'];
        } else {
            // Se não houver usuário logado, atribui um valor padrão.
            $autor = 'Anônimo';
        }
        // --- FIM DA MUDANÇA ---

        // Recebe os dados restantes do formulário de notícias
        $resumo = isset($_POST['resumo']) ? $_POST['resumo'] : null;
        $corpo_do_texto = isset($_POST['corpo_do_texto']) ? $_POST['corpo_do_texto'] : null;
        $data_de_publicacao = isset($_POST['data_de_publicacao']) ? $_POST['data_de_publicacao'] : null;
        $referencias = isset($_POST['referencias']) ? $_POST['referencias'] : null;
        $imagem_nome = NULL; // Inicializa o nome da imagem como nulo

        // Processa o upload da imagem
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $imagem_tmp = $_FILES['imagem']['tmp_name'];
            $imagem_info = pathinfo($_FILES['imagem']['name']);
            $imagem_extensao = strtolower($imagem_info['extension']);
            $imagem_nome = uniqid('img_') . '.' . $imagem_extensao;
            $imagem_destino = $upload_dir . $imagem_nome;

            if (!move_uploaded_file($imagem_tmp, $imagem_destino)) {
                die("Erro ao fazer o upload da imagem.");
            }
        }

        // Prepara e executa a query SQL para a tabela 'noticias'
        $sql = "INSERT INTO noticias (autor, resumo, corpo_do_texto, data_de_publicacao, referencias, imagem) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        // A ordem dos parâmetros deve corresponder à ordem das colunas na query SQL.
        $stmt->bind_param("ssssss", $autor, $resumo, $corpo_do_texto, $data_de_publicacao, $referencias, $imagem_nome);

        if ($stmt->execute()) {
            echo "<h1>Notícia salva com sucesso!</h1>";
        } else {
            echo "<h1>Erro ao salvar a notícia: " . $stmt->error . "</h1>";
        }
        $stmt->close();
    } 
    // 4. Processa o formulário de eventos
    else if ($form_type === 'evento') {
        // Recebe os dados do formulário de eventos
        $nome_evento = isset($_POST['nome_evento']) ? $_POST['nome_evento'] : null;
        $data_inicio_evento = isset($_POST['data_inicio_evento']) ? $_POST['data_inicio_evento'] : null;
        $data_termino_evento = isset($_POST['data_termino_evento']) ? $_POST['data_termino_evento'] : null;
        $hora_evento = isset($_POST['hora_evento']) ? $_POST['hora_evento'] : null;
        $local_evento = isset($_POST['local_evento']) ? $_POST['local_evento'] : null;
        $descricao_evento = isset($_POST['descricao_evento']) ? $_POST['descricao_evento'] : null;
        $imagem_nome = NULL;

        // Processa o upload da imagem (mesma lógica da notícia)
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $imagem_tmp = $_FILES['imagem']['tmp_name'];
            $imagem_info = pathinfo($_FILES['imagem']['name']);
            $imagem_extensao = strtolower($imagem_info['extension']);
            $imagem_nome = uniqid('event_') . '.' . $imagem_extensao;
            $imagem_destino = $upload_dir . $imagem_nome;

            if (!move_uploaded_file($imagem_tmp, $imagem_destino)) {
                die("Erro ao fazer o upload da imagem do evento.");
            }
        }

        // Prepara e executa a query SQL para a tabela 'eventos'
        // Adicionadas as colunas 'data_inicio_evento', 'data_termino_evento' e 'confirmacoes'
        $sql = "INSERT INTO eventos (nome_evento, data_inicio_evento, data_termino_evento, hora_evento, local_evento, descricao_evento, imagem_evento, confirmacoes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $confirmacoes_inicial = 0; // Inicializa o contador de 'Eu vou'
        $stmt->bind_param("ssssssss", $nome_evento, $data_inicio_evento, $data_termino_evento, $hora_evento, $local_evento, $descricao_evento, $imagem_nome, $confirmacoes_inicial);

        if ($stmt->execute()) {
            echo "<h1>Evento salvo com sucesso!</h1>";
        } else {
            echo "<h1>Erro ao salvar o evento: " . $stmt->error . "</h1>";
        }
        $stmt->close();
    }

}
// Fecha a conexão com o banco de dados
$con->close();
include __DIR__ . '/../includes/header.php';

?>


