<?php require_once 'includes/redireccion.php'; //para comprobar q este logeado
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php //require_once 'includes/lateral.php'; 
?>



<!-- CAJA PRINCIPAL -->
<div id="principal">
	<h1>Crear categorias</h1>
	<p class="text-dark">
		Añade nuevas categorias al blog para que los usuarios puedan
		usarlas al crear sus entradas.
	</p>
	<br />
	<form action="guardar-categoria.php" method="POST">
		<label class="col-form-label" for="nombre">Nombre de la categoría:</label>
		<input class="form-control" style="font-size: 30px; color:black;" type="text" name="nombre" />
		<?php echo isset($_SESSION['errores_categoria']) ? mostrarError($_SESSION['errores_categoria'], 'nombre') : ''; ?>

		<input class="btn btn-primary mt-3" type="submit" value="Guardar" />
	</form>
	<?php borrarErrores(); ?>

</div> <!--fin principal-->

<?php require_once 'includes/pie.php'; ?>