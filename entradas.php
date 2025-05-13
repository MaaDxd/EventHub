<?php require_once 'includes/cabecera.php'; ?>

<?php //require_once 'includes/lateral.php'; 
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Inicio</a>
    </li>
    <li class="breadcrumb-item">
      <a href="#">Entradas</a>
    </li>
  </ol>
</nav>
<!-- CAJA PRINCIPAL -->
<div class="container my-5">
  <h1>Todas las entradas</h1>
  
  <div class="row">
    <?php
    $entradas = conseguirEntradas($db);
    if (!empty($entradas)):
      while ($entrada = mysqli_fetch_assoc($entradas)):
    ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100 shadow-sm transition-card" style="transition: all 0.3s ease;">
            <div class="card-img-container" style="height: 200px; overflow: hidden; background-color: #f5f5f5; border-radius: 8px 8px 0 0;">
              <img src="img/cubes.png" class="card-img-top" alt="Imagen de evento" style="object-fit: cover; height: 100%; width: 100%; transition: transform 0.3s ease;">
            </div>
            <a href="entrada.php?id=<?= $entrada['id'] ?>" class="text-decoration-none text-dark">
              <div class="card-body">
                <h5 class="card-title fw-bold"><?= $entrada['titulo'] ?></h5>
                <p class="card-text text-muted"><?= substr($entrada['descripcion'], 0, 180) . "..." ?></p>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <span class="badge bg-primary rounded-pill px-3"><?= $entrada['categoria'] ?></span>
                  <small class="text-muted fst-italic"><?= $entrada['fecha'] ?></small>
                </div>
              </div>
            </a>
          </div>
        </div>

  <?php
    endwhile;
  endif; ?>

  </div>
</div>

<?php require_once 'includes/pie.php'; ?>