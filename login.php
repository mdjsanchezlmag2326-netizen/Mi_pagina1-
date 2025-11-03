<?php
session_start();
include 'conexion.php';
$mensaje = '';
if(isset($_POST['login'])){
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $sql = "SELECT * FROM usuarios WHERE correo='$correo'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if(password_verify($contraseña, $row['contraseña'])){
            $_SESSION['usuario'] = $row['nombre'];
            $_SESSION['id_usuario'] = $row['id'];
            header("Location: index.php");
        } else {
            $mensaje = "Contraseña incorrecta";
        }
    } else {
        $mensaje = "Usuario no encontrado";
    }
}
?><!DOCTYPE html><html lang="es">
<head>
<meta charset="UTF-8">
<title>Login - Papelería Papel y Magia</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<h1>Iniciar Sesión</h1>
<form method="post">
<label>Correo:</label>
<input type="email" name="correo" required>
<label>Contraseña:</label>
<input type="password" name="contraseña" required>
<button type="submit" name="login">Ingresar</button>
</form>
<p><?php echo $mensaje; ?></p>
<a href="registro.php">Registrarse</a>
</body>
</html>/
