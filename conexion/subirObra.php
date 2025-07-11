<?php 
session_start();

if(!isset($_SESSION['username'])){
    header("Location: conexion/logout.php");
}

require 'db.php';

$foto = $_FILES['pngUpload'];
$imageData = file_get_contents($foto['tmp_name']);
$foto64 = base64_encode($imageData); //codificar foto a base64

$descrip = $_POST['descrip'];

//id de la sesión activa
$idusr=$conexion->query("SELECT id_usuario FROM usuario WHERE nick like '".$_SESSION['username']."'");
$idusr=$idusr->fetch_column();

//subir la foto codificada a la base de datos
$conexion->query("INSERT INTO `portafolio`(`foto`,`descripcion`,`id_usuario`) VALUES ('".$foto64."','".$descrip."','".$idusr."')");
$conexion->commit();

header("Location: ../perfil.php");

?>