<?php

$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$categoria = $_POST['categoria'];
$marca = $_POST['marca'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$fechavencimiento = $_POST['fecha'];

$carpetaimagen = "./Sobe/productos/";
$servidorimagen = $_SERVER['DOCUMENT_ROOT'] . $carpetaimagen;
$imagen = $_FILES['imagen']['name'];
$extension = pathinfo($imagen, PATHINFO_EXTENSION);

$sqlcantidad = "SELECT COUNT(*) FROM producto WHERE p_codigo = " . $codigo . "";
$query = $pdo->query($sqlcantidad);
$cantidad = $query->fetchColumn();

if ($cantidad != 0) {
    echo '<script language="javascript">alert("El producto esta registrado");</script>';
} elseif ($extension != 'jpg') {
    echo '<script language="javascript">alert(" Imagen JPG");</script>';
} else {
    $nombre_imagen = "PRO" . $fecha . "COD" . $hora . "." . $extension;
    $destinoimagen = $servidorimagen . $nombre_imagen; //RUTA DONDE SE ALAMCENA IMAGEN 
    $rutaimagen = $_FILES['imagen']['tmp_name'];
    $imagenBD = $carpetaimagen . $nombre_imagen;
    $sql = "INSERT INTO producto(p_codigo, p_nombre, p_categoria, p_marca, p_precio, p_stock, p_foto, p_fecha_vencimiento) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $ejecutar = $pdo->prepare($sql);
    $ejecutar->execute(array($codigo, $nombre, $categoria, $marca, $precio, $stock, $imagenBD, $fechavencimiento));
    copy($rutaimagen, $destinoimagen);
    echo '<script language="javascript">alert("Registro Exitoso");</script>';
    Conexion::desconectar();
}
?>