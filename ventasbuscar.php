<?php
$datobuscar = $_GET['dato'];
?>
<?php include_once 'headprivado.php' ?>

<body >
    <?php include_once 'navadmin.php' ?>
    <main>
        <div class="card-header bg-primary" style="color: white;">
            <strong>MODULO DE VENTAS GENERALES</strong>
        </div>
        <br/>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h6> Tabla de ventas</h6>
                    <form action="ventasbuscar.php" method="GET">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control form-control-sm" name="dato" id="dato" placeholder="Buscar por Factura o Fecha" >
                            <button type="submit" class="btn btn-secondary btn-sm" btn-ms><i class='bx bx-search'></i></button>
                        </div>
                    </form>
                </div>

                <!--CREAR -->

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                        <th scope="col"><center>No.</center></th>
                        <th scope="col"><center>Factura</center></th>
                        <th scope="col"><center>Total</center></th>
                        <th scope="col"><center>Identificacion</center></th>
                        <th scope="col"><center>Cliente</center></th>

                        <th scope="col"><center>Fecha facturacion</center></th>

                        <th scope="col"><center>Ver</center></th>

                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $producto = 'SELECT SUM(v_total) AS total, v_factura, v_fecha, v_identificacion, v_nombresapellidos FROM venta WHERE v_factura LIKE "%'.$datobuscar.'%" OR v_fecha LIKE "%'.$datobuscar.'%" GROUP BY v_factura;';
                            $contador = 1;
                            foreach ($pdo->query($producto) as $dato) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $contador; ?></th>
                                    <td><?php echo $dato['v_factura'] ?></td>
                                    <td><?php echo $dato['total'] ?></td>
                                    <td><?php echo $dato['v_identificacion'] ?></td>
                                    <td><?php echo $dato['v_nombresapellidos'] ?></td>
                                    <td><?php echo $dato['v_fecha'] ?></td>

                                    <td><a href="facturacliente.php?fac=<?php echo $dato['v_factura'] ?>" class="btn btn-primary"">  <i class='bx bxs-file'></i></a></td>

                                </tr>
                                <?php
                                $contador = $contador + 1;
                            }
                            ?>  

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </main>

<?php include_once 'footer.php' ?>

</body>
</html>

