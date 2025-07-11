<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sube tu obra maestra</title>
</head>
<body>
    <?php include 'nav.php';?>

    <div class="registro-div-formulario">
        <h1 class="registro-h1">Subir arte</h1>
        <form action="conexion/subirObra.php" method="post" enctype="multipart/form-data">
            <label for="pngUpload">Subir una foto:</label><br>
            <input type="file" id="pngUpload" name="pngUpload" accept="image/png"><br>
            <label for="descrip">Escribe una descripción...</label>
            <input type="text" class="registro-input" name="descrip" required minlength="1" maxlength="1000" placeholder="da Vinci me tiene envidia"><br>
            <button class="registro-input-submit" type="submit">Subir</button>
        </form>
    </div>
    
</body>
</html>