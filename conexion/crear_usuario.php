<?php
require 'db.php';

$nombre = $_POST['nombre'] ?? "";//Estos signos de interrogacion lo que hacen es validar que estas variables reciban algun tipo de dato del html, ya que si el usuario por algun motivo no ingresa algun valor va a ocasionar un error, lo que hace el operador (??) ternario es decir: si esta variable ($nombre) es NULL (No esta contiene ningun valor esto tambien incluye el valor del espacio " ") entonces agregale un valor de espacio " " (Espacio en blanco) 
$apellido = $_POST['apellido'] ?? "";
$alias = $_POST['nombre_usuario'] ?? "";
$contraseña = $_POST['contraseña'] ?? "";
$confirmar_contraseña = $_POST['confirmacion_contraseña'] ?? "";
$fechaN = $_POST['fecha_nacimiento'];

//Validamos la confirmacion de la contraseña
if($contraseña != $confirmar_contraseña){
    header("location: registroUsuario.php?error=contDif");
    $conexion->close();
}

//--verificar que alias no exista
if($alias==" " or str_contains($alias, "*")){
    header("Location: registro.php?error=invAlias");
    $conexion->close();
}
$verif = $conexion->query("SELECT nick FROM `usuario` where usuario.nick like '$alias'");
$result = $verif->fetch_assoc()['nick'] ?? ""; //Con el fetch_assoc() obtenemos el resultado de la consulta y con el ['alias'] obtenemos el valor del alias que se encuentra en la base de datos, si no existe nos devuelve un valor nulo (NULL) gracias al operador de coalescencia nula (??) que le pusimos arriba a la variable $result
if($result==$alias){
    header("Location: registro.php?error=usrExiste");
    $conexion->close();
}

//Convertimos la contraseña del usuario en una contraseña hash ejemplo: Pepe = (#/$&!)#=(!"ROJQIOWJHE()#"Y)!12039821083e2jioqw esto es gracias a la funcion password_hash()
$contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

$stmt = $conexion->prepare("INSERT INTO usuario (nombres, apellidos, nick, passw, fecha_nacimiento, fecha_registro) VALUES (?, ?, ?, ?, ?, CURDATE())"); //Los signos interrogatorios nos indican que los valores (VALUES) a ingresar no se estan indicando aca si no que se indicaran mas adelante y ahora el CURDATE() lo que hace es agregar la fecha de hoy en la base de datos
$stmt->bind_param("sssss", $nombre, $apellido, $alias, $contraseña_hash, $fechaN);//Aca con la funcion bind_param() estamos insertando los valores ahora si los que el usuario ingreso en "registro.html"

if ($stmt->execute()) {
    /*echo "Usuario creado correctamente."; */
    header("Location: ../index.php?error=usrCreado");
} else {
    echo "Error al insertar: " . $stmt->error;
}
?>
