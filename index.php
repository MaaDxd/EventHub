<?php
require_once 'includes/cabecera.php'; ?>

<!-- Sección Hero con Slider -->
<div class="container-fluid px-0 mb-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
    </ol>
  </nav>
  
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <div class="slider">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="https://www.sopitas.com/wp-content/uploads/2016/04/tumblr_static_3s1vib38g52c8kgc8cgggggkk_640_v2.gif" class="d-block w-100" alt="Eventos musicales">
              <div class="carousel-caption">
                <h5>Eventos musicales</h5>
                <p>Tu próxima aventura empieza aquí.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="https://i.gifer.com/QwMf.gif" class="d-block w-100" alt="Eventos deportivos">
              <div class="carousel-caption">
                <h5>Deportivos</h5>
                <p>Momentos inolvidables, a solo un clic</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="https://i.gifer.com/Yi2l.gif" class="d-block w-100" alt="Otros eventos">
              <div class="carousel-caption">
                <h5>Y Demás Tipos de Eventos</h5>
                <p>Explora, conecta y disfruta tu ciudad</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Sección de Últimas Entradas -->
<div class="container">
  <h1>Últimas entradas</h1>
  
  <div class="row">

  <?php
  $entradas = conseguirEntradas($db, true);
  if (!empty($entradas)):
    while ($entrada = mysqli_fetch_assoc($entradas)): //lo hacemos asociativo
  ?>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-img-container" style="height: 200px; overflow: hidden; background-color: #f5f5f5;">
            <img src="img/cubes.png" class="card-img-top" alt="Imagen de evento" style="object-fit: cover; height: 100%; width: 100%;">
          </div>
          <a href="entrada.php?id=<?= $entrada['id'] ?>" class="text-decoration-none">
            <div class="card-body">
              <h5 class="card-title"><?= $entrada['titulo'] ?></h5>
              <p class="card-text"><?= substr($entrada['descripcion'], 0, 180) . "..." ?></p>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="badge bg-primary"><?= $entrada['categoria'] ?></span>
                <small class="text-muted"><?= $entrada['fecha'] ?></small>
              </div>
            </div>
          </a>
        </div>
      </div>
  <?php
    endwhile;
  endif;
  ?>

</div>

</div>

<div id="ver-todas" class="text-center mb-5">
  <a href="entradas.php" class="btn btn-primary px-4 py-2">Ver todas las entradas</a>
</div>

</div> <!-- Cierre del container -->

<?php require_once 'includes/pie.php'; ?>