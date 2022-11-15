<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once 'configuracion/conexion.php';
	
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
		
		

			$upload_dir = 'imagenes/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			$userpic = rand(1000,1000000).".".$imgExt;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '1MB'
				if($imgSize < 1000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
					$errMSG = "Su archivo es muy grande.";
				}
			}
			else{
				$errMSG = "Solo archivos JPG, JPEG, PNG & GIF son permitidos.";		
			}
		
		
		
		// if no error occured, continue ....
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
				header("refresh:3;index.php"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "Error al insertar ...";
			}
		}
	}
?>