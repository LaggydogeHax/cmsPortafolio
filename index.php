<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Inicio de sesión</title>
</head>
<body>
    <?php
        $pag="login";
        include 'nav.php';
    ?>

    <div class="envolvedor">
        <div class="contenido">
            <div class="index-div-sesion">
                <h1 class="index-h1">Inicio de sesión</h1>
                <form action="conexion/login.php" method="post" class="index-form">
                    <input type="text" minlength="3" maxlength="30" class="index-input" name="nombre_usuario" placeholder="Usuario" required><br>
                    <input type="password" minlength="3" maxlength="20" class="index-input" name="contraseña_usuario" placeholder="Contraseña" required>
                    <input type="submit" value="Entrar" class="index-input-submit">
                </form>
            </div>

            <p class="index-p-error index-errorMsg"> <!-- muestra mensaje de error por url (ver login.php) -->
                <?php
                    if(isset($_GET['error'])){
                        switch($_GET['error']){
                            case "noUser":
                                echo "<u>Usuario no encontrado</u>";
                            break;
                            case "contInv":
                                echo "<u>Contraseña incorrecta</u>";
                            break;
                            case "usrCreado":
                                echo "<u>Usuario creado correctamente, inicie sesión</u>";
                            break;
                        }
                    }
                ?>
            </p>

            <p class="index-p">¿No te has registrado? <a href="registroUsuario.php" target="_self" class="index-a">Registrate aqui</a></p>

        </div>
        <div class="index-fondo">
            <div class="backg-container">
                <div class="backg-infinito"></div>
            </div>
        </div>
    </div>

    
</body>
</html>