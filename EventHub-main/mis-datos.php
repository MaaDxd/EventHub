<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php //require_once 'includes/lateral.php'; 
?>



<!-- CAJA PRINCIPAL -->
<div id="principal">
	<h1>Mis datos</h1>
	<?php if (isset($_SESSION['completado'])): //esta session se crea en el archivo actualizar-usuario q dice Tus datos se han actualizado con éxito
	?>
		<div class="alert alert-success" role="alert">
			<?= $_SESSION['completado'] ?>
		</div>
	<?php elseif (isset($_SESSION['errores']['general'])): ?>
		<div class="alert alert-danger" role="alert">
			<?= $_SESSION['errores']['general'] //esta tambien se crea en actualizar-usuario si ay un error al actualizar
			?>
		</div>
	<?php endif; ?>

	<div class="row justify-content-lg-center">
		<div class="col-10 col-m-6 col-lg-4 m-3">
			<form action="actualizar-usuario.php" method="POST">
				<label class="col-form-label" for="nombre">Nombre</label>
				<input class="form-control" type="text" name="nombre" value="<?= $_SESSION['usuario']['nombre']; ?>" /><?php //al logearme se creo esta session q  le habia pasado un array asociativo q tiene al usuario en si 
																														?>
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; //$_SESSION['errores'] se crea en actualizar errores y te muestra el error con la funcion
				?>

				<label class="col-form-label" for="apellidos">Apellidos</label>
				<input class="form-control" type="text" name="apellidos" value="<?= $_SESSION['usuario']['apellidos']; ?>" />
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

				<label class="col-form-label" for="email">Email</label>
				<input class="form-control" type="email" name="email" value="<?= $_SESSION['usuario']['email']; ?>" />
				<?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

				<input class="btn btn-dark mt-3" type="submit" name="submit" value="Actualizar" />
			</form>
		</div>
	</div>
	<?php borrarErrores(); //borra las sessiones
	?>

</div> <!--fin principal-->

<?php require_once 'includes/pie.php'; ?>