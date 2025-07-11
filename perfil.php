<?php 
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: conexion/logout.php");
    }

    require 'conexion/db.php';

    $idusr=$conexion->query("SELECT id_usuario FROM usuario WHERE nick like '".$_SESSION['username']."'");
    $idusr=$idusr->fetch_column();

    $id_fotoperfil=$conexion->query("SELECT id_fotoperfil from usuario where id_usuario like '".$idusr."'");
    $id_fotoperfil=$id_fotoperfil->fetch_column();
    $sinfoto=false;
    if($id_fotoperfil==null){
        $sinfoto=true;
    }else{
        $foto64 = $conexion->query("SELECT foto from fotos_perfil where id_fotoperfil like '".$id_fotoperfil."'");
        $foto64 = $foto64->fetch_column();
    }

    $datosPersonales=$conexion->query("SELECT nombres,apellidos,bio,nick,fecha_nacimiento FROM usuario where id_usuario like '".$idusr."'");
    $datosPersonales=$datosPersonales->fetch_assoc();

    if($datosPersonales['bio']==null){
        $datosPersonales['bio']="No se proporcionó una bio";
    }

    //agarrar imagenes y sus descripciones subidas a la db
    $masterpieces = $conexion->query("SELECT foto,descripcion from portafolio where id_usuario like '".$idusr."'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
    <?php include 'nav.php'?>

    <div class="fondo-div-perfil">
        <h1 class="perfi-h1"><?= htmlspecialchars($datosPersonales['nick'])?></h1>
        <img src="<?php if($sinfoto){
            echo "img/placeholder.png";
            }else{
                echo "data:image/png;base64,$foto64";
            } ?>" alt="Foto de perfil" class="perfil-img">
    
        <form action="conexion/subirPFP.php" method="post" enctype="multipart/form-data">
            <label for="pngUpload">Subir una foto de perfil:</label>
            <input type="file" id="pngUpload" name="pngUpload" accept="image/png">
            <button type="submit">Subir</button>
        </form>

        <p class="perfil-nombapellidos"><?= htmlspecialchars($datosPersonales['apellidos']." ".$datosPersonales['nombres']." (".$datosPersonales['fecha_nacimiento'].")")?></p>
        <p class="perfil-p"><?= htmlspecialchars($datosPersonales['bio']) ?></p>
        
        <hr>
        <h3>Mi trabajo:</h3>
        <div class="obrasmaestras">
            <?php while($obra=$masterpieces->fetch_assoc()):?>
                <div class="item-portafolio">
                    <img src="data:image/png;base64,<?= htmlspecialchars($obra['foto'])?>">
                    <div class="desc-img-portafolio"><?= htmlspecialchars($obra['descripcion'])?></div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    
</body>
</html>