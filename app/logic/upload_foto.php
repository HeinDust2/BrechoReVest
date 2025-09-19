<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use Imagine\Gd\Imagine;
use Imagine\Image\Box;

header('Content-Type: application/json');

$imagine = new Imagine();
$uploadDir = __DIR__ . '/../uploads/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

$result = ['sucesso' => false, 'arquivos' => [], 'mensagem' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['imagens']['name'][0])) {
    foreach ($_FILES['imagens']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['imagens']['error'][$key] !== UPLOAD_ERR_OK) {
            $result['mensagem'] = "Erro no upload da imagem: " . $_FILES['imagens']['error'][$key];
            echo json_encode($result);
            exit;
        }

        $nome = uniqid() . '.' . strtolower(pathinfo($_FILES['imagens']['name'][$key], PATHINFO_EXTENSION));
        $destino = $uploadDir . $nome;

        try {
            $image = $imagine->open($tmp_name);

            // Orientação EXIF
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

            // Redimensiona para 1200x1200 mantendo proporção
            $size = $image->getSize();
            $ratio = $size->getWidth() / $size->getHeight();
            if ($ratio > 1) {
                $width = 1200; $height = intval(1200 / $ratio);
            } else {
                $height = 1200; $width = intval(1200 * $ratio);
            }
            $image->resize(new Box($width, $height))->save($destino, ['quality' => 90]);
            $result['arquivos'][] = $nome;

        } catch (\Exception $e) {
            $result['mensagem'] = $e->getMessage();
            echo json_encode($result);
            exit;
        }
    }
    $result['sucesso'] = true;
} else {
    $result['mensagem'] = "Nenhuma imagem enviada.";
}

echo json_encode($result);
