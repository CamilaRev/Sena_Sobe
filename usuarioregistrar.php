<?php

$cedula = $_POST['cedula'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$celular = $_POST['celular'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$fechanacimiento = $_POST['fecha'];
$contrasena = $_POST['contrasena'];
$contrasena2 = $_POST['contrasena2'];

$sqlcantidad = "SELECT COUNT(*) FROM usuario WHERE u_identificacion = '$cedula' ";
$query = $pdo->query($sqlcantidad);
$cantidad = $query->fetchColumn();

if ($contrasena != $contrasena2) {
    echo '<script language="javascript">alert("Contraseñas no coinciden");</script>';
} elseif ($cantidad != 0) {
    echo '<script language="javascript">alert("Usuario esta registrado");</script>';
} else {

    $sql = "INSERT INTO usuario(u_nombres, u_apellidos, u_identificacion, u_email, u_ciudad, u_direccion, u_celular, u_fecha_nacimiento, u_tipo, u_contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $ejecutar = $pdo->prepare($sql);
    $ejecutar->execute(array($nombres, $apellidos, $cedula, $email, $ciudad, $direccion, $celular, $fechanacimiento, 2, $contrasena));
    echo '<script language="javascript">alert("Registro Exitoso");</script>';
    Conexion::desconectar();
}
?>