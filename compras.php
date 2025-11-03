<?php
session_start();
include 'conexion.php';
if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit;
}
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT * FROM compras WHERE id_usuario=$id_usuario ORDER BY fecha DESC";
$result = $conn->query($sql);
?><!DOCTYPE html><html lang="es">
<head>
<meta charset="UTF-8">
<title>Mis Compras - Papelería Papel y Magia</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<h1>Historial de Compras</h1>
<a href="index.php">Volver al catálogo</a>
<table border="1">
<tr><th>ID Compra</th><th>Fecha</th><th>Total</th></tr>
<?php
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['fecha']."</td>";
        echo "<td>$".$row['total']."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No hay compras realizadas</td></tr>";
}
?>
</table>
</body>
</html>/
