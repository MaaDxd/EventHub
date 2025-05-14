<?php require_once "conexion.php" ?>
<?php require_once "helpers.php" ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eventhub - Tu portal de eventos</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Estilos personalizados -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/modern-style.css">
  <!-- Fuentes -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

  <div class="container">

    <header class="col-md-12  mt-2">

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <div id="logo">
              <a href="index.php">Eventhub</a>
            </div>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="bi bi-house-fill me-1"></i> Inicio</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-tag-fill me-1"></i> Categorías
                </a>
                <ul class="dropdown-menu">
                  <!--<li><a class="dropdown-item" href="#">Action</a></li>-->
                  <?php
                  $categorias = conseguirCategorias($db);
                  if (!empty($categorias)):
                    while ($categoria = mysqli_fetch_assoc($categorias)): //saco el array asociativo del query q hice
                  ?>
                      <li>
                        <a class="dropdown-item" href="categoria.php?id=<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></a><?php //aca muestro el nombre y cuando toco se lleva el id de la categoria
                                                                                                                            ?>
                      </li>
                  <?php
                    endwhile;
                  endif;
                  ?>

                </ul>
              </li>
              <?php if (!isset($_SESSION['usuario'])): //si no existe esta session no me muetra todo esto /////////
              ?>
                <li class="nav-item">
                  <a type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#inicio-sesion">
                    Inicio de sesion
                  </a>
                </li>
                <li class="nav-item">
                  <a type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#registro">
                    Registro
                  </a>
                </li>

              <?php endif; ?>

              <?php if (isset($_SESSION['usuario'])): //si existe $_SESSION['usuario'] es porqe se logeo correctamente y me muestra esto
              ?>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle"></i></a><?php //$_SESSION['usuario']es un array asociativo le muestro el nombre y el apellido 
                                                                                                                                                                                                                        ?>
                  <!--botones-->

                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item" href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
                      <a class="dropdown-item" href="crear-categoria.php" class="dropdown-item">Crear categoria</a>
                      <a class="dropdown-item" href="mis-datos.php" class="dropdown-item">Mis datos</a>
                      <a class="dropdown-item" href="cerrar.php" class="dropdown-item">Cerrar sesión</a>
                    </li>
                  </ul>


                </li>

              <?php endif; ?>

            </ul>
            <form action="buscar.php" method="POST" class="d-flex" role="search">
              <input name="busqueda" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>

          <?php if (!isset($_SESSION['usuario'])): //si no existe esta session no me muetra todo esto /////////
          ?>
            <!--agregado inicio sesion-->
            <!-- Modal -->
            <div class="modal fade" id="inicio-sesion" tabindex="-1" aria-labelledby="inicio-sesion" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="login.php" method="POST">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Identificate</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="email">

                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!--fin agregado inicio sesion-->

            <!--agregado registro sesion-->
            <!-- Modal -->
            <div class="modal fade" id="registro" tabindex="-1" aria-labelledby="registro" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="registro.php" method="POST">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Registro</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                      <label for="nombre" class="form-label">Nombre</label>
                      <input type="text" name="nombre" class="form-control" id="nombre">

                      <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?><?php //si existe la session errores mostramos lo q dice con la funcion mostrarerrores 
                                                                                                                    ?>

                      <label for="apellidos" class="form-label">Apellidos</label>
                      <input type="text" name="apellidos" class="form-control" id="apellidos">
                      <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?><?php //si existe la session errores mostramos lo q dice con la funcion mostrarerrores 
                                                                                                                        ?>

                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="email">
                      <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?><?php //si existe la session errores mostramos lo q dice con la funcion mostrarerrores 
                                                                                                                    ?>

                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password">

                      <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?><?php //si existe la session errores mostramos lo q dice con la funcion mostrarerrores 
                                                                                                                      ?>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!--fin agregado registro sesion-->
          <?php endif;  ?>

        </div>
      </nav>

    </header>