<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="img/logo2.png">
</head>
<body>
    
    <header class="encabezado-header">
            <?php
                if(isset($_SESSION['username'])){
                    echo '
                        <div class="encabezado-div-logo">
                            <a><img src="img/logo2.png" alt="Logo de empresa" class="encabezado-img-logo"></a>
                        </div>
                        <nav>
                            <ul class="encabezado-ul">
                                <li class="encabezado-li" style= "padding:0"><a class="encabezado-a"><button class="encabezado-button">'.$_SESSION['username'].'</button></a></li>
                            </ul>
                        </nav>
                        <a href="form_subirArte.php"><button class="encabezado-button">Subir arte</button></a>
                        <a href="conexion/logout.php"><button class="encabezado-button">Cerrar Sesion</button></a>
                    ';
                }elseif(!isset($_SESSION['username'])){
                    echo '
                        <div class="encabezado-div-logo">
                            <li class="encabezado-li"><a><img src="img/logo2.png" alt="Logo de empresa" class="encabezado-img-logo"></a></li>
                        </div>
                        <nav>
                            <ul class="encabezado-ul">';
                                if(isset($pag)){
                                    if($pag=="login"){
                                        echo '<li class="encabezado-li"><a href="registroUsuario.php" class="encabezado-a">Registrarse</a></li>';
                                    }else{
                                        echo '<li class="encabezado-li"><a href="index.php" class="encabezado-a">Iniciar Sesion</a></li>';
                                    }
                                }else{
                                    echo '<li class="encabezado-li"><a href="index.php" class="encabezado-a">error</a></li>';
                                }
                                echo '
                            </ul>
                        </nav>
                    ';
                }
            ?>
    </header>
</body>
</html>


