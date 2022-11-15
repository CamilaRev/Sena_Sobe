<?php include_once 'headprivado.php' ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    date_default_timezone_set('America/Bogota');
    $hora = date("His");
    $fecha = date("Ymd");
    $accion = $_POST['accion'];
     if ($accion == 2) {
        include_once 'productoactualizar.php';
    } else if ($accion == 3) {
        $id = $_POST['id'];
        $imageneliminar = $_POST['imageneliminar'];
        $borrarimageneliminar = $_SERVER['DOCUMENT_ROOT'] . $imageneliminar;

        $sqlcarrito = "SELECT COUNT(*) FROM carrito WHERE c_idproductofk  = '$id'";
        $querycarrito2 = $pdo->query($sqlcarrito);
        $cantidadcarrito = $querycarrito2->fetchColumn();
        if ($cantidadcarrito != 0) {
         echo '<script language="javascript">alert("El producto esta en carrito por algun cliente");</script>';
        } else {
        $eliminar = "DELETE FROM producto WHERE p_id = ?";
        $ejecutar = $pdo->prepare($eliminar);
        $ejecutar->execute(array($id));
        unlink($borrarimageneliminar);
        echo '<script language="javascript">alert("Eliminacion Exitosa");</script>';
        Conexion::desconectar();
        }
        
    }
	// Funcionalidad registrar
	
	if(isset($_POST['btnsave']))
	{
	$codigo = $_POST['codigo'];
	$nombre = $_POST['nombre'];
	$categoria = $_POST['categoria'];
	$marca = $_POST['marca'];
	$precio = $_POST['precio'];
	$stock = $_POST['stock'];
	$fechavencimiento = $_POST['fecha'];
		
	$imgFile = $_FILES['user_image']['name'];
	$tmp_dir = $_FILES['user_image']['tmp_name'];
	$imgSize = $_FILES['user_image']['size'];
		
    $sqlcantidad = "SELECT COUNT(*) FROM producto WHERE codigo = " .$codigo . "";
    $query = $pdo->query($sqlcantidad);
    $cantidad = $query->fetchColumn();	

    if ($cantidad != 0) {
        echo '<script language="javascript">alert("El producto esta registrado");</script>';
    }else{

                $upload_dir = 'imagenes/'; 
        
                $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
                $valid_extensions = array('jpg'); 
            
                $userpic = rand(1000,1000000).".".$imgExt;
                    
                
                if(in_array($imgExt, $valid_extensions)){			
                
                    if($imgSize < 100000000)				{
                        move_uploaded_file($tmp_dir,$upload_dir.$userpic);
                    }
                    else{
                        echo '<script language="javascript">alert("Su archivo es muy grande");</script>';
                    }
                    if(!isset($errMSG))
                    {
                        $stmt = $pdo->prepare('INSERT INTO producto(codigo,nombre, categoria, marca, precio, stock,fecha, imagen_Img) VALUES (:codigo, :nombre, :categ, :marca, :precio, :stock, :fechaven, :upic)');
                        $stmt->bindParam(':codigo',$codigo);
                        $stmt->bindParam(':nombre',$nombre);
                        $stmt->bindParam(':categ',$categoria);
                        $stmt->bindParam(':marca',$marca);
                        $stmt->bindParam(':precio',$precio);
                        $stmt->bindParam(':stock',$stock);
                        $stmt->bindParam(':fechaven',$fechavencimiento);
                        $stmt->bindParam(':upic',$userpic);
                        
                        if($stmt->execute())
                        {
                            $successMSG = "Nuevo registro insertado correctamente ...";
                            header("refresh:3;producto.php"); 
                        }
                        else
                        {
                            $errMSG = "Error al insertar ...";
                        }
                    }
                }
                else{
                    echo '<script language="javascript">alert("Solo se acepta imagen en formato jpg");</script>';	
                }
            
            

        }
    }
}
?>
<?php 
	
        /////////////////////////
    // Funcionalidad para eliminar productos
        if(isset($_GET['delete_id']))
        {
       
            $stmt_select = $pdo->prepare('SELECT imagen_Img FROM producto WHERE p_id =:uid');
            $stmt_select->execute(array(':uid'=>$_GET['delete_id']));
            $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
         
            unlink("imagenes/".$imgRow['imagen_Img']);
            
            $stmt_delete = $pdo->prepare('DELETE FROM producto WHERE p_id =:uid');
            $stmt_delete->bindParam(':uid',$_GET['delete_id']);
            $stmt_delete->execute();
          
            header("Location: producto.php");
        }
?>

<body>
    <?php include_once 'navadmin.php' ?>
    <main>
        <div class="card-header bg-primary" style="color: white;">
            <strong>MODULO DE PRODUCTOS</strong>
        </div>
        <br />

        <div class="container">

            <div class="card">
                <div class="card-header">
                    <h6> Tabla de productos</h6>
                    <form action="productobuscar.php" method="GET">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><button type="button" class="btn btn-primary btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#exampleModalRegistrar">
                                    <i class='bx bxs-add-to-queue'></i>&nbsp;&nbsp;Registrar
                                </button></span>
                            <input type="search" class="form-control form-control-sm" name="dato" id="dato"
                                placeholder="Buscar por Codigo o Nombre">
                            <button type="submit" class="btn btn-secondary btn-sm" btn-ms><i
                                    class='bx bx-search'></i></button>
                        </div>
                    </form>
                </div>

        <!-- Formulario registro de productos -->

                <div class="modal fade" id="exampleModalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form ROLE="FORM" METHOD="POST" ENCTYPE="MULTIPART/FORM-DATA" ACTION="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">

                                                <input type="text" class="form-control" id="codigo" name="codigo"
                                                    placeholder="Codigo del producto" required>
                                            </div>

                                            <div class="mb-3">

                                                <input type="text" class="form-control" id="nombre" name="nombre"
                                                    placeholder="Nombres del producto" required>
                                            </div>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text"
                                                    for="inputGroupSelect01">Categoria</label>
                                                <select class="form-select" id="categoria" name="categoria">
                                                <option selected>Seleccione...</option>
                                                <option value="1">Maquillaje</option>
                                                <option value="2">Cuidado facial</option>
                                                <option value="3">Cuidado corporal</option>
                                                <option value="4">Fragancias</option>
                                                </select>
                                            </div>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupSelect01">Marca</label>
                                                <select class="form-select" id="marca" name="marca">
                                                <option selected>Seleccione...</option>
                                                <option value="1">Bioderma</option>
                                                <option value="2">Esika</option>
                                                <option value="3">Sefora</option>
                                                <option value="4">Avon</option>
                                                <option value="5">Cyzone</option>
                                                <option value="6">Victoria secret</option>
                                                <option value="7">Yambal</option>
                                                </select>
                                            </div>


                                        </div>
                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <input type="number" class="form-control" id="precio" name="precio"
                                                    placeholder="Precio del producto" min="1" pattern="^[0-9]+"
                                                    required>
                                            </div>


                                            <div class="mb-3">
                                                <input type="number" class="form-control" id="stock" name="stock"
                                                    placeholder="stock del producto" min="1" pattern="^[0-9]+" required>


                                            </div>

                                            <div class="mb-3">
                                                <input class="input-group" type="file" name="user_image"
                                                    accept="image/*" />
                                            </div>
                                            <div class="mb-3">
                                                <input type="date" class="form-control" id="fecha" name="fecha"
                                                    min="2022-10-01" max="2024-01-01" placeholder="Fecha de Vencimiento"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" name="btnsave" class="btn btn-default"> <span
                                            class="glyphicon glyphicon-save"></span> &nbsp; Guardar </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ******************************** -->

                <!-- Visualizacion de la informacion de productos -->

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <center>Codigo</center>
                                </th>
                                <th scope="col">
                                    <center>Nombre</center>
                                </th>
                                <th scope="col">
                                    <center>Categoria</center>
                                </th>
                                <th scope="col">
                                    <center>Marca</center>
                                </th>
                                <th scope="col">
                                    <center>Precio</center>
                                </th>
                                <th scope="col">
                                    <center>Stock</center>
                                </th>
                                <th scope="col">
                                    <center>Foto</center>
                                    </center>
                                </th>
                                <th scope="col">
                                    <center>Fecha Vencimiento</center>
                                </th>
                                <th scope="col">
                                    <center>Actualizar</center>
                                </th>
                                <th scope="col">
                                    <center>Eliminar</center>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $stmt = $pdo->prepare('SELECT * FROM producto ORDER BY p_id DESC');
                            $stmt->execute();
                            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                    extract($row);
		
                            ?>
                            <tr>
                                <th scope="row"><?php echo $row['codigo'] ?></th>
                                <td><?php echo $row['nombre'] ?></td>
                                <td><?php echo $row['categoria'] ?></td>
                                <td><?php echo $row['marca'] ?></td>
                                <td><?php echo $row['precio'] ?></td>
                                <td><?php echo $row['stock'] ?></td>
                                <td><img src="imagenes/<?php echo $row['imagen_Img']; ?>" class="img-rounded"
                                        width="250px" height="250px" /></td>
                                <td><?php echo $row['fecha'] ?></td>

                                <!-- ******************************** -->

                                <!-- Boton para dirigirse al formulario para modificar producto-->
                                <td>
                                    <p class="page-header"> <span> <a class="btn btn-info"
                                                href="productoactualizar.php?edit_id=<?php echo $row['p_id']; ?>"
                                                title="click for edit"
                                                onclick="return confirm('Esta seguro de editar el archivo ?')"><span
                                                    class="glyphicon glyphicon-edit"></span> Editar</a> </span> </p>

                                </td>

                                <td>
                                    <p class="page-header"> <a class="btn btn-danger"
                                            href="?delete_id=<?php echo $row['p_id']; ?>" title="click for delete"
                                            onclick="return confirm('Esta seguro de eliminar el registro?')"><span
                                                class="glyphicon glyphicon-remove-circle"></span> Borrar</a> </span>
                                    </p>

                                    <!-- Eliminar producto -->
                                   
                                    <div class="modal fade" id="exampleModalEliminar<?php echo $dato['p_id'] ?>"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="exampleModalEliminar<?php echo $dato['p_id'] ?>">Eliminar
                                                        Producto</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form ROLE="FORM" METHOD="POST" ACTION="">
                                                        <input type="hidden" class="form-control" id="accion"
                                                            name="accion" value="3" />
                                                        <input type="hidden" class="form-control" id="id" name="id"
                                                            value="<?php echo!empty($dato['p_id']) ? $dato['p_id'] : ''; ?>""  />
                                                <input type=" hidden" class="form-control" id="imageneliminar"
                                                            name="imageneliminar"
                                                            value="<?php echo!empty($dato['imagen_Img']) ? $dato['imagen_Img'] : ''; ?>""  />

                                                <h4>¿Desea eliminar la información de: <?php echo $dato['nombre'] ?>?</h4>
                                                <p>La informacion simpre se eliminara, siempre y cuando no se este utilizando en el carrito de compra</p>
                                                <br/>
                                                <div class=" form__button__container">
                                                        <button type="submit" class="btn btn-primary">Eliminar</button>
                                                </div>
                                                </form>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                </div>
                </td>

                </tr>
                <?php } ?>

                </tbody>
                </table>
            </div>

        </div>
        </div>
    </main>

    <?php include_once 'footer.php' ?>

</body>

</html>