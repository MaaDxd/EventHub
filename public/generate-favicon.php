<?php
/**
 * Script para generar favicon ICO desde SVG
 * Ejecuta este archivo una vez para generar el favicon.ico
 */

// Verificar si GD está disponible
if (!extension_loaded('gd')) {
    die('La extensión GD no está disponible. Instala php-gd para continuar.');
}

// Función para crear un favicon simple usando GD
function createFavicon() {
    // Crear imagen de 32x32
    $image = imagecreatetruecolor(32, 32);
    
    // Definir colores
    $purple = imagecolorallocate($image, 139, 92, 246); // #8B5CF6
    $darkPurple = imagecolorallocate($image, 26, 0, 70); // #1A0046
    $white = imagecolorallocate($image, 255, 255, 255);
    $orange = imagecolorallocate($image, 245, 158, 11); // #F59E0B
    $transparent = imagecolorallocate($image, 0, 0, 0);
    
    // Hacer el fondo transparente
    imagefill($image, 0, 0, $transparent);
    imagecolortransparent($image, $transparent);
    
    // Dibujar círculo de fondo con gradiente simulado
    imagefilledellipse($image, 16, 16, 30, 30, $purple);
    imagefilledellipse($image, 16, 16, 28, 28, $darkPurple);
    
    // Dibujar calendario (rectángulo blanco)
    imagefilledrectangle($image, 8, 10, 24, 22, $white);
    
    // Encabezado del calendario
    imagefilledrectangle($image, 8, 10, 24, 13, $darkPurple);
    
    // Líneas del calendario
    imageline($image, 12, 16, 20, 16, $darkPurple);
    imageline($image, 12, 19, 18, 19, $darkPurple);
    
    // Punto decorativo
    imagefilledellipse($image, 22, 8, 4, 4, $orange);
    
    // Guardar como PNG primero
    imagepng($image, 'favicon-32x32.png');
    
    // Crear imagen de 16x16
    $image16 = imagecreatetruecolor(16, 16);
    imagefill($image16, 0, 0, $transparent);
    imagecolortransparent($image16, $transparent);
    
    // Escalar la imagen de 32x32 a 16x16
    imagecopyresampled($image16, $image, 0, 0, 0, 0, 16, 16, 32, 32);
    
    // Guardar como PNG
    imagepng($image16, 'favicon-16x16.png');
    
    // Liberar memoria
    imagedestroy($image);
    imagedestroy($image16);
    
    echo "Favicons generados exitosamente:\n";
    echo "- favicon-32x32.png\n";
    echo "- favicon-16x16.png\n";
    echo "\nPara crear el favicon.ico, usa una herramienta online como:\n";
    echo "https://www.favicon-generator.org/\n";
    echo "o instala ImageMagick y ejecuta:\n";
    echo "convert favicon-16x16.png favicon-32x32.png favicon.ico\n";
}

// Ejecutar la función
createFavicon();
?>
