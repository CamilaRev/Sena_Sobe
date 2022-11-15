<?php include_once 'head.php' ?>

<body>
    <?php include_once 'navinicio.php' ?>
    <main>
        <div class="card-header bg-primary" style="color: white;">
            <strong>CATALOGO DE SOBE</strong>
        </div>
 <center>       <br />
<video autoplay="autoplay" loop="loop" muted defaultMuted playsinline  oncontextmenu="return false;"  preload="auto" width="640" height="360" controls >
    <source src="videos/video1.mp4" type="video/mp4">
    
</video>
 </center>



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
                                    <img src="imagenes/<?php echo $dato['imagen_Img'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">

                                        <form ROLE="FORM" METHOD="POST" ACTION="">
                                        <p class="card-text">Nombre: <strong><?php echo $dato['nombre'] ?></strong></p>
                                            <p class="card-text">Marca: <strong><?php echo $dato['marca'] ?></strong></p>
                                            <p class="card-text">Valor: $ <strong><?php echo $dato['precio'] ?></strong> COP</p>
                                            <p class="card-text">Disponible: <strong><?php echo $dato['stock'] ?></strong></p>
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