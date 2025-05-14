<?php
if (!isset($_POST['busqueda'])) {
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
			<a href="#">Search</a>
		</li>
	</ol>
</nav>

<h1>Busqueda: <?= $_POST['busqueda'] ?></h1>
<!-- CAJA PRINCIPAL -->
<div class="row">

	<?php
	$entradas = conseguirEntradas($db, null, null, $_POST['busqueda']);

	if (!empty($entradas) && mysqli_num_rows($entradas) >= 1): //si es diferente a vacio y ay mas de una
		while ($entrada = mysqli_fetch_assoc($entradas)): //lo hacemos asociativo
	?>
			<div class="col-sm-6">
				<div class="card m-4">
					<div class="card-img-container" style="height: 200px; overflow: hidden; background-color: #f5f5f5;">
						<img src="img/cubes.png" class="card-img-top" alt="Imagen de evento" style="object-fit: cover; height: 100%; width: 100%;">
					</div>
					<a href="entrada.php?id=<?= $entrada['id'] ?>"><?php //me lleva a ver el detalle de la entrada y poder hacer abm de ella 
																	?>
						<div class="card-body">
							<h5 class="card-title"><?= $entrada['titulo'] ?></h5>

							<p class="card-text"><small class="text-dark"><?= substr($entrada['descripcion'], 0, 180) . "..." ?><?php // substr es una funcion q me limita los caracteres q yo quiera de 0 a 180
																															?></small></p>

							<p class="card-text"><small class="text-muted"><?= $entrada['categoria'] . ' | ' . $entrada['fecha'] ?></small></p>
						</div>
					</a>
				</div>
			</div>
		<?php
		endwhile;
	else: //si no no ay entradas
		?>
		<div class="alert alert-dark" role="alert">>No hay entradas en esta Busqueda</div>
	<?php endif; ?>
</div> <!--fin principal-->

<?php require_once 'includes/pie.php'; ?>