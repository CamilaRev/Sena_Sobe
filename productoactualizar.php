<?php

$id = $_POST['id'];
$codigo = $_POST['codigo'];
$codigoviejo = $_POST['codigoviejo'];
$nombre = $_POST['nombre'];
$categoria = $_POST['categoria'];
$marca = $_POST['marca'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$fechavencimiento = $_POST['fecha'];
$imagenvieja = $_POST['imagenvieja'];

$carpetaimagen = "./Sobe/productos/";
$servidorimagen = $_SERVER['DOCUMENT_ROOT'] . $carpetaimagen;
$imagen = $_FILES['imagen']['name'];
$extension = pathinfo($imagen, PATHINFO_EXTENSION);

function validarproducto($codigo, $codigoviejo) {
    if ($codigoviejo != $codigo) {
        $cantidad = 1;
    } else {
        $cantidad = 0;
    }
    return $cantidad;
}

function validarimagen($imagen) {
    if ($imagen != "") {
        $cantidad = 1;
    } else {
        $cantidad = 0;
    }
    return $cantidad;
}

$ProductoValidar = validarproducto($codigo, $codigoviejo);
$ProductoImagen = validarimagen($imagen);


$nombre_imagen = "PRO" . $fecha . "COD" . $hora . "." . $extension;
$destinoimagen = $servidorimagen . $nombre_imagen; //RUTA DONDE SE ALAMCENA IMAGEN 
$rutaimagen = $_FILES['imagen']['tmp_name'];
$imagenBD = $carpetaimagen . $nombre_imagen;


$sqlcantidad = "SELECT COUNT(*) FROM producto WHERE p_codigo = " . $codigo . "";
$ejecutarcant = $pdo->query($sqlcantidad);
$cantidad = $ejecutarcant->fetchColumn();
$borrarimagen = $_SERVER['DOCUMENT_ROOT'] . $imagenvieja;

if ($ProductoValidar == 1 && $ProductoImagen == 1) { // actualiza los dos
    if ($cantidad != 0) {
        echo '<script language="javascript">alert("El codigo esta registrado");</script>';
    } else {

        $sql = "UPDATE producto SET p_codigo = ?, p_nombre = ?, p_categoria = ?, p_marca= ?, p_precio= ?, p_stock = ?, p_foto= ?, p_fecha_vencimiento = ?  WHERE p_id = ?";
        $ejecutar = $pdo->prepare($sql);
        $ejecutar->execute(array($codigo, $nombre, $categoria, $marca, $precio, $stock, $imagenBD, $fechavencimiento, $id));
        unlink($borrarimagen);
        copy($rutaimagen, $destinoimagen);
        echo '<script language="javascript">alert("Registro Actualizado Forma 1");</script>';
        Conexion::desconectar();
    }
} elseif ($ProductoValidar == 1 && $ProductoImagen == 0) { // actualiza los Codigo
    if ($cantidad != 0) {
        echo '<script language="javascript">alert("Producto ya Registrado");</script>';
    } else {
        $sql = "UPDATE producto SET p_codigo = ?, p_nombre = ?, p_categoria = ?, p_marca= ?, p_precio= ?, p_stock = ?, p_foto= ?, p_fecha_vencimiento = ?  WHERE p_id = ?";
        $ejecutar = $pdo->prepare($sql);
        $ejecutar->execute(array($codigo, $nombre, $categoria, $marca, $precio, $stock, $imagenvieja, $fechavencimiento, $id));
        echo '<script language="javascript">alert("Registro Actualizado Forma 2");</script>';
        Conexion::desconectar();
    }
} elseif ($ProductoValidar == 0 && $ProductoImagen == 1) { // actualiza los I
    $sql = "UPDATE producto SET p_codigo = ?, p_nombre = ?, p_categoria = ?, p_marca= ?, p_precio= ?, p_stock = ?, p_foto= ?, p_fecha_vencimiento = ?  WHERE p_id = ?";
    $ejecutar = $pdo->prepare($sql);
    $ejecutar->execute(array($codigoviejo, $nombre, $categoria, $marca, $precio, $stock, $imagenBD, $fechavencimiento, $id));
    unlink($borrarimagen);
    copy($rutaimagen, $destinoimagen);
    echo '<script language="javascript">alert("Registro Actualizado Forma 3");</script>';
    Conexion::desconectar();
} elseif ($ProductoValidar == 0 && $ProductoImagen == 0) { // actualiza Datos
    $sql = "UPDATE producto SET p_codigo = ?, p_nombre = ?, p_categoria = ?, p_marca= ?, p_precio= ?, p_stock = ?, p_foto= ?, p_fecha_vencimiento = ?  WHERE p_id = ?";
    $ejecutar = $pdo->prepare($sql);
    $ejecutar->execute(array($codigoviejo, $nombre, $categoria, $marca, $precio, $stock, $imagenvieja, $fechavencimiento, $id));
    echo '<script language="javascript">alert("Registro Actualizado Forma 4");</script>';
    Conexion::desconectar();
}
?>