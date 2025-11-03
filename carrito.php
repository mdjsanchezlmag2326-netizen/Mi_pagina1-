<?php
session_start();
include 'conexion.php';
if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit;
}
$id_usuario = $_SESSION['id_usuario'];

if(isset($_POST['agregar'])){
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    
    $check = "SELECT * FROM carrito WHERE id_usuario=$id_usuario AND id_producto=$id_producto";
    $res = $conn->query($check);
    if($res->num_rows > 0){
        $conn->query("UPDATE carrito SET cantidad=cantidad+$cantidad WHERE id_usuario=$id_usuario AND id_producto=$id_producto");
    } else {
        $conn->query("INSERT INTO carrito (id_usuario,id_producto,cantidad) VALUES ($id_usuario,$id_producto,$cantidad)");
    }
}


if(isset($_GET['eliminar'])){
    $id = $_GET['eliminar'];
    $conn->query("DELETE FROM carrito WHERE id=$id");
}


$sql = "SELECT carrito.id as id_carrito, productos.*, carrito.cantidad FROM carrito 
        JOIN productos ON carrito.id_producto=productos.id 
        WHERE carrito.id_usuario=$id_usuario";
$result = $conn->query($sql);


if(isset($_POST['comprar'])){
    $total = 0;
    while($row = $result->fetch_assoc()){
        $total += $row['precio'] * $row['cantidad'];
    }
    $conn->query("INSERT INTO compras (id_usuario,total) VALUES ($id_usuario,$total)");
    $conn->query("DELETE FROM carrito WHERE id_usuario=$id_usuario");
    header("Location: compras.php");
}
?><!DOCTYPE html><html lang="es">
<head>
<meta charset="UTF-8">
<title>Carrito - Papelería Papel y Magia</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<h1>Mi Carrito</h1>
<a href="index.php">Volver al catálogo</a>
<table border="1">
<tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th>Acción</th></tr>
<?php
$result = $conn->query($sql);
$total = 0;
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $subtotal = $row['precio'] * $row['cantidad'];
        $total += $subtotal;
        echo "<tr>";
        echo "<td>".$row['nombre']."</td>";
        echo "<td>$".$row['precio']."</td>";
        echo "<td>".$row['cantidad']."</td>";
        echo "<td>$".$subtotal."</td>";
        echo "<td><a href='carrito.php?eliminar=".$row['id_carrito']."'>Eliminar</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay productos en el carrito</td></tr>";
}
echo "<tr><td colspan='3'>Total</td><td>$".$total."</td><td></td></tr>";
?>
</table>
<form method="post"><button type="submit" name="comprar">Comprar</button></form>
</body>
</html>/
