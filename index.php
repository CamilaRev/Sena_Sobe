<?php include_once 'head.php' ?>

<body>
  <?php include_once 'navinicio.php'

  ?>


  <link rel="stylesheet" href="css/index.css">
  <figure class="text-center">
    <BR><BR>
    <h1 class="display-2"><strong>BIENVENIDO/A</strong></h1>
  </figure>
  <div class="container__card">

    <div class="card__father">
      <div class="card1">
        <div class="card__front" style="background-image: url(productos/img2.png);">
          <div class="bg"></div>
          <div class="body__card_front">
            <h1><strong>¿Por qué maquillarse tiene beneficios?</strong></h1>
          </div>
        </div>
        <div class="card__back">
          <div class="body__card_back">
            <h1></h1>
            <p>Maquillarse eleva la autoestima,realza la belleza y corrige las imperfecciones "que aveces son molestas"
              haciendo que nos sientamos mas comodas con nuestra apariencia y de esta manera ganar seguridad</p>


          </div>
        </div>
      </div>
    </div>

    <div class="card__father">
      <div class="card1">
        <div class="card__front" style="background-image: url(productos/img3.png);">
          <div class="bg"></div>
          <div class="body__card_front">
            <h1><strong>¿Por qué usar nuestros cosméticos?</strong></h1>
          </div>
        </div>
        <div class="card__back">
          <div class="body__card_back">
            <h1>PENSAMOS EN TÍ</h1>
            <p>por que nosotros le ofrecemos productos de calidad siempre pensando en la piel de los clientes y que no pierdan la salud de su piel y su juventud prematuramente </p>

          </div>
        </div>
      </div>
    </div>

    <div class="card__father">
      <div class="card1">
        <div class="card__front" style="background-image: url(prodyctos/img4.png);">
          <div class="bg"></div>
          <div class="body__card_front">
            <h1><strong> "MIRA AQUÍ"</strong></h1>
          </div>
        </div>
        <div class="card__back">
          <div class="body__card_back">
            <h1>¡No se arrepentira!</h1>
            <p>Sin duda es la mejor comprá que hará</p>

          </div>
        </div>

      </div>

    </div>
    <br> <br> <br>


    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>


      <div class="container">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="5000">
            <img src="productos/q.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1>SOBE</h1>
              <h3><strong> "Que tu día sea tan perfecto como tu maquillaje"</strong></h3>
            </div>
          </div>

          <div class="carousel-item" data-bs-interval="5000">
            <img src="productos/m1.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h1></h1>
              <h3><strong> "La vida es más bonita con café, pestañas y actitud" </strong></h3>
            </div>
          </div>

          <div class="carousel-item" data-bs-interval="5000">
            <img src="productos/v1.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">

              <h3><strong> la creatividad es tu mejor habilidad de maquillaje, no tengas miedo de experimentar</strong></h3>
            </div>
          </div>


        </div>


        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    </div>


  </div>

  <?php  ?>
  <?php include_once 'footer.php' ?>




  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>


  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="js/jquery-3.2.1.slim.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script src="script.js"></script>
  

</body>

</html>