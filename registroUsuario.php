<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario</title>
</head>
<body>
    <?php
        $pag="reg";
        include 'nav.php';
    ?>
    <br><br>
    <div class="registro-div-formulario">
        <h1 class="registro-h1">Registro</h1><br>
        <form action="conexion/crear_usuario.php" method="POST">
            <div class="registro-div-nombre-apellido-flexbox">
                <input type="text" minlength="3" maxlength="30" placeholder="Ingrese su nombre" name="nombre" class="registro-input-nombre" required>
                <input type="text" minlength="3" maxlength="30" placeholder="Ingrese su apellido" name="apellido" class="registro-input-apellido" required>
            </div>
            <input type="text" minlength="3" maxlength="30" placeholder="Ingrese su nombre de usuario" name="nombre_usuario" class="registro-input" required>
            <div class="registro-div-nombre-apellido-flexbox">
                <label for="fecha_nacimiento" class="registro-label-fch">Fecha de nacimiento:</label>
                <input type="date" max="<?= htmlspecialchars(date("Y-m-d"))?>" required name="fecha_nacimiento" class="registro-input-fch">
            </div>
            <input type="password" minlength="3" maxlength="20" placeholder="Ingrese la contraseña" name="contraseña" class="registro-input" required>
            <input type="password" minlength="3" maxlength="20" placeholder="Confirme su contraseña" name="confirmacion_contraseña" class="registro-input contraseña" required>
            <input type="submit" value="Registrarse" class="registro-input-submit">
        </form>
    </div>
    
    <p class="index-errorMsg">
        <?php
            if(isset($_GET['error'])){
                switch($_GET['error']){
                    case "contDif":
                        echo "<u>Las contraseñas no coinciden</u>";
                    break;
                    case "invAlias":
                        echo "<u>Alias invalido</u>";
                    break;
                    case "usrExiste":
                        echo "<u>El alias ya existe, inicie sesión o elija otro alias</u>";
                    break;
                }
            }
        ?>
    </p>

    <p class="registro-p">¿Ya estás registrado? <a href="index.php" target="_self" class="registro-a">Inicia sesion aqui</a></p>
</body>
</html>