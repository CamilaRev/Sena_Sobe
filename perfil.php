<?php include_once 'headprivado.php' ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idusuario = $_POST['idusuario'];
    $cedula = $_POST['cedula'];
    $cedulavieja = $_POST['cedulavieja'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $ciudad = $_POST['ciudad'];
    $direccion = $_POST['direccion'];
    $fechanacimiento = $_POST['fecha'];
    $contrasena = $_POST['contrasena'];

    function validarcedula($cedula, $cedulavieja) {
        if ($cedula != $cedulavieja) {
            $cantidad = 1;
        } else {
            $cantidad = 0;
        }
        return $cantidad;
    }

    $ValidarC = validarcedula($cedula, $cedulavieja);

    $sqlcantidad = "SELECT COUNT(*) FROM usuario WHERE u_identificacion = '$cedula' ";
    $query = $pdo->query($sqlcantidad);
    $cantidad = $query->fetchColumn();
    if ($ValidarC == 1) {

        if ($cantidad != 0) {
            echo '<script language="javascript">alert("Usuario esta registrado");</script>';
        } else {

            $sql = "UPDATE usuario SET u_nombres = ?,u_apellidos = ?,u_identificacion = ?,u_email = ?,u_ciudad = ?,u_direccion = ?,u_celular = ?,u_fecha_nacimiento = ? ,u_contrasena = ? WHERE  u_id = ?       ";
            $ejecutar = $pdo->prepare($sql);
            $ejecutar->execute(array($nombres, $apellidos, $cedula, $email, $ciudad, $direccion, $celular, $fechanacimiento, $contrasena, $idusuario));
            echo '<script language="javascript">alert("Actualizacion exitosa con cedula nueva");</script>';
            Conexion::desconectar();
        }
    } else {

        $sql = "UPDATE usuario SET u_nombres = ?, u_apellidos = ?, u_identificacion = ?,u_email = ?,u_ciudad = ?,u_direccion = ?,u_celular = ?,u_fecha_nacimiento = ? ,u_contrasena = ? WHERE  u_id = ?       ";
        $ejecutar = $pdo->prepare($sql);
        $ejecutar->execute(array($nombres, $apellidos, $cedulavieja, $email, $ciudad, $direccion, $celular, $fechanacimiento, $contrasena, $idusuario));
        echo '<script language="javascript">alert("Actualizacion exitosa");</script>';
        Conexion::desconectar();
    }
}
?>

<body >
<?php include_once 'navcliente.php' ?>
    <main>
        <div class="card-header bg-primary" style="color: white;">
            <strong>PERFIL DEL USUARIO</strong>
        </div>
        <br/>

        <div class="container">
            <div class="card">
                <h5 class="card-header">Información de usuario</h5>
                <div class="card-body">
                    <form  ROLE="FORM" METHOD="POST" ACTION="">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-3">
                                    
                                    <input type="hidden" class="form-control" id="idusuario" name="idusuario"  value="<?php echo!empty($idadmin) ? $idadmin : ''; ?>">
                                    <input type="number" class="form-control" id="cedula" name="cedula"  value="<?php echo!empty($cedulaadmin) ? $cedulaadmin : ''; ?>" placeholder="Ingrese su numero de Cedula" min="1" pattern="^[0-9]+" required>
                                    <input type="hidden" class="form-control" id="cedulavieja" name="cedulavieja"  value="<?php echo!empty($cedulaadmin) ? $cedulaadmin : ''; ?>" >

                                </div>

                                <div class="mb-3">
                                    
                                    <input type="text" class="form-control" id="nombres" name="nombres"  value="<?php echo!empty($nombresadmin) ? $nombresadmin : ''; ?>" placeholder="Ingrese sus Nombres" required>
                                </div>

                                <div class="mb-3">
                                    
                                    <input type="text" class="form-control" id="apellidos" name="apellidos"  value="<?php echo!empty($apellidosadmin) ? $apellidosadmin : ''; ?>" placeholder="Ingrese sus Apellidos" required>
                                </div>

                                <div class="mb-3">
                                    
                                    <input type="email" class="form-control" id="email" name="email"  value="<?php echo!empty($emailadmin) ? $emailadmin : ''; ?>" placeholder="Ingrese su Correo Electronico" required>
                                </div>

                                <div class="mb-3">
                                    
                                    <input type="number" class="form-control" id="celular" name="celular"  value="<?php echo!empty($celularadmin) ? $cedulaadmin : ''; ?>" placeholder="Ingrese su numero de Celular" min="1" pattern="^[0-9]+" required>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    
                                    <input type="text" class="form-control" id="ciudad" name="ciudad"  value="<?php echo!empty($ciudadadmin) ? $ciudadadmin : ''; ?>" placeholder="Ingrese su Ciudad" required>
                                </div>
                                <div class="mb-3">
                                    
                                    <input type="text" class="form-control" id="direccion" name="direccion"  value="<?php echo!empty($direccionadmin) ? $direccionadmin : ''; ?>" placeholder="Ingrese su Direccion" required>
                                </div>
                                <div class="mb-3">
                                    
                                    <input type="date" class="form-control" id="fecha" name="fecha"  value="<?php echo!empty($fechanacimientoadmin) ? $fechanacimientoadmin : ''; ?>" placeholder="Ingrese su Fecha de nacimiento" required>
                                </div>

                                <div class="mb-3">
                                   
                                    <input type="password" class="form-control" id="contrasena" name="contrasena"  value="<?php echo!empty($contrasenaadmin) ? $contrasenaadmin : ''; ?>" placeholder="Ingrese su Contraseña" required>
                                </div>

                            </div>
                        </div>

                        <center><button type="submit" class="btn btn-primary">Actualizar</button></center>
                    </form>
                </div>
            </div>
        </div>

    </main>

<?php include_once 'footer.php' ?>

</body>
</html>

