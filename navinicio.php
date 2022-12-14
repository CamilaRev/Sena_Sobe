
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    date_default_timezone_set('America/Bogota');
    $hora = date("His");
    $fecha = date("Ymd");
    $accion = $_POST['accion'];
    if ($accion == 10) {
        include_once 'usuarioregistrar.php';
    } elseif ($accion == 11) {
        session_start(); // allows us to retrieve our key form the session
        include_once('configuracion/conexion.php');
        $pdo = Conexion::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['usuario'];
            $contrasena = $_POST['contrasena'];

            $sql = "SELECT COUNT(*) FROM usuario WHERE u_identificacion = '$usuario' AND u_contrasena  = '$contrasena'";
            $query = $pdo->query($sql);
            $cantidad = $query->fetchColumn();

            if ($cantidad == 0) {
                echo '<script language="javascript">alert("Usuario y/o contrasena no registrado");</script>';
            } else {

                $sql = "SELECT * FROM usuario WHERE u_identificacion = ? AND u_contrasena = ? ";
                $ejecutar = $pdo->prepare($sql);
                $ejecutar->execute(array($usuario, $contrasena));
                $dato = $ejecutar->fetch(PDO::FETCH_ASSOC);
                $tipo = $dato['u_tipo'];
                if ($tipo == 1) { // ADMINSTRADOR
                    $_SESSION['permitido'] = 'SI';
                    $_SESSION['usuario'] = $dato['u_id'];
                    header("Location: admin.php");
                    Conexion::desconectar();
                } elseif ($tipo == 2) { // CLIENTE
                    $_SESSION['permitido'] = 'SI';
                    $_SESSION['usuario'] = $dato['u_id'];
                    header("Location: cliente.php");
                    Conexion::desconectar();
                } else {
                }
            }
        }
    }
}
?>



<nav class="navbar navbar-expand-lg  sticky-top nav_inicio">

<div class="burbujas">
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
        <div class="burbuja"></div>
  </div>
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> <img src="productos/LogoP.png" alt="logo belleza" style="width: 30%; height: 30%;">
            <h3></h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">
                        <h3><strong>Inicio</strong></h3>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="presentacion.php">
                        <h3><strong>Cat??logo</strong></h3>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="usuarioregistrar.php" data-bs-toggle="modal" data-bs-target="#exampleModalUsuario">
                        <h3><strong> Registrarme </strong></h3>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModalsesion">
                        <h3><strong> Iniciar sesi??n</strong></h3>
                    </a>
                </li>
            </ul>
        </div>
    </div>
   
</nav>

<div class="modal fade " id="exampleModalUsuario" tabindex="-1" aria-labelledby="exampleModalUsuario" aria-hidden="true">
    <div class=" modal-dialog modal-dialog-centered modal-xl ">
        <div class="modal-content container__registro">
            <div class="modal-header container__login">
               <h5 class="modal-title" id="exampleModalUsuario"><strong>REGISTRARME</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form ROLE="FORM" METHOD="POST" ACTION="">
                    <input type="hidden" class="form-control" id="accion" name="accion" value="10">

                    <div class="row">
                        <div class="col-md-6">

                            <div class="mb-3">

                                <input type="number" class="form-control" id="cedula" name="cedula" placeholder="Ingrese su numero de Cedula" min="1" pattern="^[0-9]+" required>
                            </div>

                            <div class="mb-3">

                                <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese sus Nombres" required>
                            </div>

                            <div class="mb-3">

                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingrese sus Apellidos" required>
                            </div>

                            <div class="mb-3">

                                <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su Correo Electronico" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Celular</label>
                                <input type="tel" class="form-control" id="celular" name="celular" placeholder="Ingrese su n??mero de Celular" required>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">

                                <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ingrese su Ciudad" required>
                            </div>
                            <div class="mb-3">

                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese su Direcci??n" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" min="1985-01-01" max="2004-01-01" id="fecha" name="fecha" placeholder="Ingrese su Fecha de nacimiento" required>
                            </div>

                            <div class="mb-3">

                                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingrese su Contrase??a" required>
                            </div>

                            <div class="mb-3">

                                <input type="password" class="form-control" id="contrasena2" name="contrasena2" placeholder="Confirmar su Contrase??a" required>
                            </div>

                        </div>
                    </div>




                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--INICIAR SESION-->





    <div class="modal fade" id="exampleModalsesion" tabindex="-1" aria-labelledby="exampleModalsesion" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            
            <div class="modal-content container__login_fondo">
                <div class="modal-header container__login">
                    <h5 class="modal-title" id="exampleModalsesion"><strong>INICIAR SESI??N</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form   ROLE="FORM" METHOD="POST" ACTION="">
                        <input type="hidden" class="form-control" id="accion" name="accion" value="11">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><strong>C??dula</strong></label>
                            <input type="number" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su n??mero de Cedula" min="1" pattern="^[0-9]+" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label"><strong>Contrase??a</strong></label>
                            <input type="password" class="form-control" id="password" name="contrasena" placeholder="Ingrese su Contrase??a" required>
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" name="connected" class="form-check-input" onclick="verpassword()">
                            <label for="conneted" class="form-check-label">Mostrar Contrase??a</label>
                        </div>
                        <center><button type="submit" class="btn btn-primary">Aceptar</button></center>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

<script>
    function verpassword() {
        var tipo = document.getElementById("password");
        if (tipo.type == "password") {
            tipo.type = "text";
        } else {
            tipo.type = "password";
        }
    }
</script>