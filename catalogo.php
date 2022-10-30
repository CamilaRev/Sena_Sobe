<?php include_once 'headprivado.php' ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idproducto = $_POST['idproducto'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $cantidad = $_POST['cantidad'];
    $idcliente = $_POST['idcliente'];

    if ($stock <= 0) {
        echo '<script language="javascript">alert("Producto no disponibles");</script>';
    } elseif ($cantidad > $stock) {
        echo '<script language="javascript">alert("La cantidad esta por encima del stock");</script>';
    } else {
        $total = $cantidad * $precio;
        $disponible = $stock - $cantidad;
        $sqlinsertar = "INSERT INTO carrito(c_idproductofk, c_nombre, c_marca, c_precio, c_cantidad, c_total, c_idusuariofk) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $ejecutarinsertar = $pdo->prepare($sqlinsertar);
        $ejecutarinsertar->execute(array($idproducto, $nombre, $marca, $precio, $cantidad, $total, $idcliente));
        $sqlactualizar = "UPDATE producto SET p_stock = ? WHERE p_id = ?";
        $ejecutaractualizar = $pdo->prepare($sqlactualizar);
        $ejecutaractualizar->execute(array($disponible, $idproducto));
        Conexion::desconectar();
    }
}
?>

<body>
    <?php include_once 'navcliente.php' ?>
    <main>
        <div class="card-header bg-primary" style="color: white;">
            <strong>CATÁLOGO DE SOBE</strong>
        </div>
        <br />

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h6>Catalogo</h6>
                    <form action="catalogobuscar.php" method="GET">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control form-control-sm" name="dato" id="dato" placeholder="Buscar por Nombre o Marca">
                            <button type="submit" class="btn btn-secondary btn-sm" btn-ms><i class='bx bx-search'></i></button>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <div class="row">
                        <?php
                        $producto = 'SELECT * FROM producto ORDER BY p_id DESC;';
                        foreach ($pdo->query($producto) as $dato) {
                        ?>
                            <div class="col">
                                <div class="card" style="width: 18rem;">
                                    <img src="http://localhost/<?php echo $dato['p_foto'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">

                                        <form ROLE="FORM" METHOD="POST" ACTION="">
                                            <center>
                                                <h5 class="card-title"><?php echo $dato['p_nombre'] ?></h5>
                                            </center>
                                            <p class="card-text">Marca: <strong><?php echo $dato['p_marca'] ?></strong></p>
                                            <p class="card-text">Valor: $ <strong><?php echo $dato['p_precio'] ?></strong> COP</p>
                                            <p class="card-text">Disponible: <strong><?php echo $dato['p_stock'] ?></strong></p>

                                            <div class="mb-3">
                                                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ingresar Cantidad" min="1" pattern="^[0-9]+" required>
                                            </div>
                                            <input type="hidden" class="form-control" id="idproducto" name="idproducto" value="<?php echo !empty($dato['p_id']) ? $dato['p_id'] : ''; ?>" required>
                                            <input type="hidden" class="form-control" id="nombre" name="nombre" value="<?php echo !empty($dato['p_nombre']) ? $dato['p_nombre'] : ''; ?>" required>
                                            <input type="hidden" class="form-control" id="marca" name="marca" value="<?php echo !empty($dato['p_marca']) ? $dato['p_marca'] : ''; ?>" required>
                                            <input type="hidden" class="form-control" id="precio" name="precio" value="<?php echo !empty($dato['p_precio']) ? $dato['p_precio'] : ''; ?>" required>
                                            <input type="hidden" class="form-control" id="stock" name="stock" value="<?php echo !empty($dato['p_stock']) ? $dato['p_stock'] : ''; ?>" required>
                                            <input type="hidden" class="form-control" id="idcliente" name="idcliente" value="<?php echo $idadmin; ?>" required>
                                            <center> <button type="submit" class="btn btn-primary btn-sm">Añadir Carrito</button></center>
                                        </form>


                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>

            </div>
        </div>
        <?php include_once 'footer.php' ?>
       
    </main>

    

</body>

</html>