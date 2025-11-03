
<?php
$host = "localhost";
$usuario = "root";
$clave = "";
$baseDatos = "papeleria_magia";

$conn = new mysqli($host, $usuario, $clave, $baseDatos);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
