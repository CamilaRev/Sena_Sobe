<?php include_once 'head.php' ?>

<body>
    <?php include_once 'navinicio.php' ?>
    <main>
        <div class="card-header bg-primary" style="color: white;">
            <strong>CATALOGO DE SOBE</strong>
        </div>
        <br />

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h6>Catalogo</h6>
                    <form action="presentacionbuscar.php" method="GET">
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
                                        <figure class="text-center">
                                                <h5 class="card-title"><?php echo $dato['p_nombre'] ?></h5>
                                        </figure>
                                            <p class="card-text">Marca: <strong><?php echo $dato['p_marca'] ?></strong></p>
                                            <p class="card-text">Valor: $ <strong><?php echo $dato['p_precio'] ?></strong> COP</p>
                                            <p class="card-text">Disponible: <strong><?php echo $dato['p_stock'] ?></strong></p>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php include_once 'footer.php' ?>

</body>

</html>