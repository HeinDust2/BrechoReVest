<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Imagine\Gd\Imagine;
use Imagine\Image\Box;

// Inicializa o gerenciador de imagens
$imagine = new Imagine();

// Pasta de uploads
$uploadDir = __DIR__ . '/../uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tmpPath = $_FILES['foto']['tmp_name'];
        $name    = basename($_FILES['foto']['name']);
        $destino = $uploadDir . $name;

        try {
            // Abre a imagem
            $image = $imagine->open($tmpPath);

            // Ajuste automático da orientação baseado no EXIF (apenas para JPEG)
            if (function_exists('exif_read_data')) {
                $exif = @exif_read_data($tmpPath);
                if ($exif && isset($exif['Orientation'])) {
                    switch ($exif['Orientation']) {
                        case 3:
                            $image->rotate(180);
                            break;
                        case 6:
                            $image->rotate(90);
                            break;
                        case 8:
                            $image->rotate(-90);
                            break;
                    }
                }
            }

            // Redimensiona mantendo proporção máxima de 800x800
            $size = $image->getSize();
            $ratio = $size->getWidth() / $size->getHeight();

            if ($ratio > 1) { // imagem mais larga
                $width = 800;
                $height = intval(800 / $ratio);
            } else { // imagem mais alta ou quadrada
                $height = 800;
                $width = intval(800 * $ratio);
            }

            $image->resize(new Box($width, $height))
                  ->save($destino, ['quality' => 90]);

            echo "<p style='color:green'>✅ Upload feito! Salvo em: {$destino}</p>";
            echo "<img src='../uploads/{$name}' alt='preview'>";

        } catch (\Exception $e) {
            echo "<p style='color:red'>Erro: " . $e->getMessage() . "</p>";
        }

    } else {
        echo "<p style='color:red'>Nenhuma imagem enviada!</p>";
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="foto" required>
    <button type="submit">Enviar</button>
</form>
