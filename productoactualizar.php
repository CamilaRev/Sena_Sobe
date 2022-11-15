<?php
error_reporting( ~E_NOTICE );	
include_once 'headprivado.php';

if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	$stmt_edit = $pdo->prepare('SELECT codigo,nombre, categoria, marca, precio, stock,fecha, imagen_Img FROM producto WHERE p_id =:uid');
	$stmt_edit->execute(array(':uid'=>$id));
	$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
	extract($edit_row);
}
else
{
	header("Location: index.php");
}	

if(isset($_POST['btn_save_updates']))
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
				
  $sqlcantidad = "SELECT COUNT(*) FROM producto WHERE codigo = " . $codigo . "";
$ejecutarcant = $pdo->query($sqlcantidad);
$cantidad = $ejecutarcant->fetchColumn();
if ($cantidad != 0) {
  echo '<script language="javascript">alert("El codigo esta registrado");</script>';
} else {

      if($imgFile)
      {
        $upload_dir = 'imagenes/';
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
        $valid_extensions = array('jpg'); 
        $userpic = rand(1000,1000000).".".$imgExt;
        if(in_array($imgExt, $valid_extensions))
        {			
          if($imgSize < 100000000)
          {
            unlink($upload_dir.$edit_row['imagen_Img']);
            move_uploaded_file($tmp_dir,$upload_dir.$userpic);
          }
          else
          {
            $errMSG = "Su archivo es demasiado grande mayor a 10MB";
          }
          if(!isset($errMSG))
          {
                $stmt = $pdo->prepare('UPDATE producto SET codigo=:codigo,nombre=:nombre, categoria=:categ, marca=:marca,precio=:precio,stock=:stock,fecha=:fechaven, imagen_Img=:upic WHERE p_id=:uid');
                    $stmt->bindParam(':codigo',$codigo);
                    $stmt->bindParam(':nombre',$nombre);
                    $stmt->bindParam(':categ',$categoria);
                    $stmt->bindParam(':marca',$marca);
                    $stmt->bindParam(':precio',$precio);
                    $stmt->bindParam(':stock',$stock);
                    $stmt->bindParam(':fechaven',$fechavencimiento);
                    $stmt->bindParam(':upic',$userpic);
                $stmt->bindParam(':uid',$id);
                  
                if($stmt->execute()){
                  ?>
                  <script>
                  alert('Archivo editado correctamente ...');
                  window.location.href = 'producto.php';
                  </script>
                  <?php
                }
                else{
                  $errMSG = "Los datos no fueron actualizados !";
                }		
          }	
        }
        else
        {
          echo '<script language="javascript">alert("Solo se acepta imagen en formato jpg");</script>';	
        }	
      }
      else
      {

        $userpic = $edit_row['imagen_Img']; 
      }	
              
      
					
  }	
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Subir imagen al servidor usando PDO MySQL</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="style.css">


</head>

<body>
    <?php include_once 'navadmin.php' ?>
    <main>
        <div class="card-header bg-primary" style="color: white;">
            <strong>MODULO DE PRODUCTOS</strong>
        </div>
        <br />
        <div class="card m-5">

            <div class="container">
                <div class="page-header">
                    <h2 class="h2 text-center">Actualización producto</h2>
                </div>
                <div class="clearfix"></div>
                <form method="post" enctype="multipart/form-data" class="form-horizontal">
                    <?php
          if(isset($errMSG)){
            ?>
                    <div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp;
                        <?php echo $errMSG; ?> </div>
                    <?php
          }
          ?>
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <td><label class="control-label">Codigo</label></td>
                            <td><input class="form-control" type="text" name="codigo" value="<?php echo $codigo; ?>"
                                    required />
                            </td>
                        </tr>
                        <tr>
                            <td><label class="control-label">Nombre</label></td>
                            <td><input class="form-control" type="text" name="nombre" value="<?php echo $nombre; ?>"
                                    required />
                            </td>
                        </tr>
                        <tr>
                            <td><label class="control-label">Categoria</label></td>
                            <td><input class="form-control" type="text" name="categoria"
                                    value="<?php echo $categoria; ?>" required /></td>
                        </tr>
                        <tr>
                            <td><label class="control-label">Marca</label></td>
                            <td><input class="form-control" type="text" name="marca" value="<?php echo $marca; ?>"
                                    required />
                            </td>
                        </tr>
                        <tr>
                            <td><label class="control-label">Precio</label></td>
                            <td><input class="form-control" type="text" name="precio" value="<?php echo $precio; ?>"
                            min="1" pattern="^[0-9]+" required />
                            </td>
                        </tr>
                        <tr>
                            <td><label class="control-label">Stock</label></td>
                            <td><input class="form-control" type="text" name="stock" value="<?php echo $stock; ?>"
                            min="1" pattern="^[0-9]+" required />
                            </td>
                        </tr>
                        <tr>
                            <td><label class="control-label">Fecha</label></td>
                            <td><input class="form-control" type="text" name="fecha" value="<?php echo $fecha; ?>"
                            min="2022-10-01" max="2024-01-01" required />
                            </td>
                        </tr>
                        <tr>
                            <td><label class="control-label">Imágen</label></td>
                            <td>
                                <p><img src="imagenes/<?php echo $imagen_Img; ?>" height="150" width="150" /></p>
                                <input class="input-group" type="file" name="user_image" accept="image/*" />
                            </td>
                        </tr>
                        <tr>
                          
                            <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default"> <span
                                        class="glyphicon glyphicon-save"></span> Actualizar </button>
                                <a class="btn btn-default" href="producto.php"> <span
                                        class="glyphicon glyphicon-backward"></span> cancelar </a>
                            </td>
                          
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </main>
    <?php include_once 'footer.php' ?>
</body>

</html>