<?php
session_start();
include 'conexion.php';
$mensaje = '';
if(isset($_POST['registrar'])){
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES ('$nombre','$correo','$contraseña')";
    if($conn->query($sql) === TRUE){
        $mensaje = "Registro exitoso. <a href='login.php'>Inicia sesión</a>";
    } else {
        $mensaje = "Error: " . $conn->error;
    }
}
?><!DOCTYPE html><html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro - Papelería Papel y Magia</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<h1>Registro de Usuario</h1>
<form method="post">
<label>Nombre:</label>
<input type="text" name="nombre" required>
<label>Correo:</label>
<input type="email" name="correo" required>
<label>Contraseña:</label>
<input type="password" name="contraseña" required>
<button type="submit" name="registrar">Registrarse</button>
</form>
<p><?php echo $mensaje; ?></p>
<a href="login.php">Iniciar sesión</a>
</body>
</html>/* 
