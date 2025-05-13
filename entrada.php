<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
$entrada_actual = conseguirEntrada($db, $_GET['id']);

if (!isset($entrada_actual['id'])) { //me patea si no ay nada
	header("Location: index.php");
}
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php //require_once 'includes/lateral.php'; 
?>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Inicio</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#">Entrada</a>
		</li>
		<li class="breadcrumb-item">
			<a href="#"><?= $entrada_actual['titulo'] ?></a>
		</li>
	</ol>
</nav>

<!-- CAJA PRINCIPAL --><?php //gracias a la query muestro esto 
						?>
<div class="container my-5">
	<div class="row">
		<div class="col-lg-10 mx-auto">
			<div class="card border-0 shadow-sm">
				<div class="card-img-container" style="height: 300px; overflow: hidden; background-color: #f5f5f5;">
					<img src="img/cubes.png" class="card-img-top" alt="Imagen del evento" style="object-fit: cover; height: 100%; width: 100%;">
				</div>
				<div class="card-body p-4">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<span class="badge bg-primary px-3 py-2 rounded-pill fs-6"><?= $entrada_actual['categoria'] ?></span>
						<div class="text-muted">
							<i class="bi bi-calendar3 me-1"></i> <?= $entrada_actual['fecha'] ?>
						</div>
					</div>
					<h1 class="card-title display-5 mb-4"><?= $entrada_actual['titulo'] ?></h1>
					<div class="mb-4">
						<i class="bi bi-person-circle me-2"></i> Publicado por: <strong><?= $entrada_actual['usuario'] ?></strong>
					</div>
					<div class="card-text fs-5 lh-lg">
						<?= $entrada_actual['descripcion'] ?>
					</div>
				</div>
		<?php if (isset($_SESSION["usuario"]) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']): //si estoy logeado y soy yo igual al usuario actual
		?>
			<br />
			<a href="editar-entrada.php?id=<?= $entrada_actual['id'] ?>" type="button" class="btn btn-outline-dark">Editar entrada</a>
			<a href="borrar-entrada.php?id=<?= $entrada_actual['id'] ?>" type="button" class="btn btn-outline-dark">Eliminar entrada</a>
		<?php endif; ?>

	</div>
</div> <!--fin principal-->

<?php require_once 'includes/pie.php'; ?>