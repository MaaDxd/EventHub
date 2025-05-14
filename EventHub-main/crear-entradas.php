<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>



<!-- CAJA PRINCIPAL -->
<div id="principal">
	<h1>Crear entradas</h1>
	<p class="text-dark">
		Añade nuevas entradas al blog para que los usuarios puedan
		leerlas y disfrutar de nuestro contenido.
	</p>
	<br />
	<div class="row justify-content-lg-center">
		<div class="col-10 col-m-6 col-lg-4 m-3">
			<form action="guardar-entrada.php" method="POST">
				<label class="col-form-label" for="titulo">Titulo:</label>
				<input class="form-control" type="text" name="titulo" />
				<?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?><?php //si existe la session errores mostramos lo q dice con la funcion mostrarerrores 
																																?>

				<label class="col-form-label" for="descripcion">Descripción:</label>
				<textarea class="form-control" name="descripcion"></textarea>
				<?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>

				<label class="col-form-label" for="categoria">Categoría</label>
				<select class="form-select" name="categoria">
					<option selected disabled>Categoría</option>
					<?php
					$categorias = conseguirCategorias($db);
					if (!empty($categorias)):
						while ($categoria = mysqli_fetch_assoc($categorias)): //creamos el asociativo
					?>
							<option value="<?= $categoria['id'] ?>"><?php //este option es para desplegar el menu de las categorias cuando elijo el nombre manda el id de la categoria
																	?>
								<?= $categoria['nombre'] ?>
							</option>
					<?php
						endwhile;
					endif;
					?>
				</select>
				<?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''; ?>

				<input class="btn btn-dark mt-3" type="submit" value="Guardar" />
			</form>
			<?php borrarErrores(); ?>
		</div>
	</div>
</div> <!--fin principal-->

<?php require_once 'includes/pie.php'; ?>