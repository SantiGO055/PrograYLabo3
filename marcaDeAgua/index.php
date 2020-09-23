<!-- <div class="container">
<h2>Example: How To Add Watermark To Images Using PHP</h2>
<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="image" value="">
<select name="image_upload">
<option value="">Selecciona la marca de agua</option>
<option value="text_watermark">Texto</option>
<option value="image_watermark">Imagen</option>
</select>
<input type="submit" value="Upload">
</form>
</div> -->

<?php
include_once '../clasesParaParcial/archivos.php';
include_once './marcaDeAgua.php';

//Archivos::guardarImagenSinAleatorio($_FILES,1024*1024*1024*1024*1024*1024,'../marcaDeAgua/pruebita');

if(isset($_FILES['archivo']['name'])){
    // Validando el tipo de imagen
    if(Archivos::esImagen($_FILES['archivo']['type'])){
        Archivos::guardarImagenSinAleatorio($_FILES,1024*1024*1024*1024*1024*1024,'../marcaDeAgua/pruebita');
        $rutaImagenOriginal = __DIR__ . "\pruebita.jpg";
        $rutaMarcaDeAgua = __DIR__ . "\marca.png";
        

        

        $original = imagecreatefromjpeg($rutaImagenOriginal);
        $marcaDeAgua = imagecreatefrompng($rutaMarcaDeAgua);
        # En dónde poner la marca de agua sobre la original
        $xOriginal = 0;
        $yOriginal = 0;
        # Desde dónde comenzar a cortar la marca de agua (si son 0, se comienza desde el inicio)
        $xMarcaDeAgua = 0;
        $yMarcaDeAgua = 0;
        # Hasta dónde poner la marca de agua sobre la original
        $alturaMarcaDeAgua = imagesy($marcaDeAgua) - $yMarcaDeAgua;
        $anchuraMarcaDeAgua = imagesx($marcaDeAgua) - $xMarcaDeAgua;
        imagecopy($original, $marcaDeAgua, $xOriginal, $yOriginal, $xMarcaDeAgua, $yMarcaDeAgua, $anchuraMarcaDeAgua, $alturaMarcaDeAgua);

        # Imprimir y liberar recursos
        header('Content-Type: image/png');
        imagejpg($original);
        imagedestroy($original);
        imagedestroy($marcaDeAgua);

    }
}


?>