<?php 
session_start();

if(!isset($_SESSION['username'])){
    header("Location: conexion/logout.php");
}

require 'db.php';

$foto = $_FILES['pngUpload'];
$imageData = file_get_contents($foto['tmp_name']);
$foto64 = base64_encode($imageData); //codificar foto a base64


$idusr=$conexion->query("SELECT id_usuario FROM usuario WHERE nick like '".$_SESSION['username']."'");
$idusr=$idusr->fetch_column();

//subir la foto codificada a la base de datos
$conexion->query("INSERT INTO `fotos_perfil`(`foto`) VALUES ('".$foto64."')");
$conexion->commit();

$id_fotosubida=$conexion->query("SELECT `id_fotoperfil` from fotos_perfil where 1 order by id_fotoperfil desc");
$id_fotosubida=$id_fotosubida->fetch_column();

//actualizar la foto de perfil
$conexion->query("UPDATE `usuario` SET `id_fotoperfil`='".$id_fotosubida."' WHERE id_usuario like '".$idusr."'");
$conexion->close();

header("Location: ../perfil.php");

?>