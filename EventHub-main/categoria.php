<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
$categoria_actual = conseguirCategoria($db, $_GET['id']); //desde la cabecera me traigo el idi de la categoria y con la funcion consigo la categoria

if (!isset($categoria_actual['id'])) { // si no existe lo pateo por si pone cualquier id en la url
    header("Location: index.php");
}
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php //require_once 'includes/lateral.php'; 
?>



<!-- CAJA PRINCIPAL -->
<h1>Entradas de <?= $categoria_actual['nombre'] ?></h1><?php //como esta como asociativa echa en la funcion la muestro como array 
                                                        ?>

<div class="row">
    <?php
    $entradas = conseguirEntradas($db, null, $_GET['id']);

    if (!empty($entradas) && mysqli_num_rows($entradas) >= 1):
        while ($entrada = mysqli_fetch_assoc($entradas)):
    ?>
            <div class="col-sm-6">
                <div class="card m-4">
                    <img src="..." class="card-img-top" alt="...">
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
    else:
        ?>
        <div class="alert alert-dark" role="alert">No hay entradas en esta categoría</div>
    <?php endif; ?>
</div> <!--fin principal-->

<?php require_once 'includes/pie.php'; ?>