<?php

require_once("scripts/php/getBook.php");
require_once("scripts/php/pdoConn.php");

class Site
{

  public function printHeader()
  {

    if (!isset($_SESSION["nombre"])) {

?>
      <div class="row pt-5">
        <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
          <a class="navbar-brand" href="http://localhost/Biblioteca/index.php">
            <img src="./img/icons/bookMainIcon.svg" alt="icon" width="40" height="40">
          </a>
          <a class="navbar-brand" href="http://localhost/Biblioteca/index.php">Librería RG</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse text-sm-center text-md-start" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <button type="button" data-bs-toggle="modal" data-bs-target="#modalLogIn" class="btn btn-primary mx-2 my-md-0 my-sm-2">Log In</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#modalRegister" class="btn btn-primary mx-2">Registro</button>
          </div>
        </nav>
      </div>


      <!--Ventas de log in y register, necesarias cuando no se esta registrado-->
      <div class="modal fade" id="modalLogIn" tabindex="-1" aria-labelledby="modalLogInLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLogInLabel">Entra en sesión</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <form id="loginForm">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" aria-describedby="email" placeholder="ejemplo@ejemplo.com">
                  </div>
                  <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contrasenaLogin" name="contrasena">
                  </div>
                  <div id="infoLoginDiv">Los datos son incorrectos</div>
                  <input type="hidden" name="tipoSolicitud" id="inputlogin" value="inputlogin">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="login" class="btn btn-primary">Log In</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="modalRegisterLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalRegisterLabel">Register</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <form id="registerForm">
                  <div class="mb-3">
                    <label for="nombre" class="form-label">Nick:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre" placeholder="hola1234">
                  </div>
                  <div class="mb-3">
                    <label for="mail" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="mail" name="mail" placeholder="ejemplo@ejemplo.com">
                  </div>
                  <div class="mb-3">
                    <label for="contrasenaRegister" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contrasenaRegister" name="contrasenaRegister">
                  </div>
                  <input type="hidden" name="tipoSolicitud" id="inputRegister" value="inputRegister">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="register" class="btn btn-primary">Registrarse</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php


    } elseif (isset($_SESSION["nombre"])) {
      if (!$_SESSION["privileges"] == 0) {

      ?>
        <div class="row pt-5">
          <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
            <a class="navbar-brand" href="http://localhost/Biblioteca/index.php">
              <img src="./img/icons/bookMainIcon.svg" alt="icon" width="40" height="40">
            </a>
            <a class="navbar-brand" href="http://localhost/Biblioteca/index.php">Librería RG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse text-sm-center text-md-start" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown align-middle mt-2 px-2 text-white">
                  Buenas <?= $_SESSION["nombre"] ?>
                </li>
              </ul>
              <a href="admin.php" class="btn btn-primary mx-2 my-md-0 my-sm-2"><i class="fa fa-tasks" aria-hidden="true"></i></a>
              <a href="user.php" class="btn btn-primary mx-2 my-md-0 my-sm-2"><i class="fa fa-book" aria-hidden="true"></i></a>
              <a href="scripts/php/logout.php" class="btn btn-primary mx-2">Cerrar Sesión</a>
            </div>
          </nav>
        </div>
      <?php

      } else {

      ?>
        <div class="row pt-5">
          <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
            <a class="navbar-brand" href="http://localhost/Biblioteca/index.php">
              <img src="./img/icons/bookMainIcon.svg" alt="icon" width="40" height="40">
            </a>
            <a class="navbar-brand" href="http://localhost/Biblioteca/index.php">Librería RG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse text-sm-center text-md-start" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown align-middle mt-2 px-2 text-white">
                  Buenas <?= $_SESSION["nombre"] ?>
                </li>
              </ul>
              <a href="user.php" class="btn btn-primary mx-2 my-md-0 my-sm-2"><i class="fa fa-book" aria-hidden="true"></i></a>
              <a href="scripts/php/logout.php" class="btn btn-primary mx-2">Cerrar Sesión</a>
            </div>
          </nav>
        </div>
    <?php

      }
    }
  }

  public function printBody()
  {
    ?>

    <div class="row">
      <div class="col-md-12 pt-5 pb-4 text-center bckColorBlue">
        <h1>Bienvenido a la Libreria RG</h1>
        <h2>¡Echa un vistazo!, ¡puedes alquilar lo que encuentres!</h2>
      </div>
      <hr>
      <div class="col-sm-12">
        <h4 class="text-center">LIBROS RECOMENDADOS</h4>
        <hr><br>
        <div class="row" id="recomendedBooks">
        </div>
      </div>
      <div class="col-sm-12 text-center py-3 bckColorBlue">
        <h4 class="pt-2">BÚSQUEDA DE LIBROS</h4>
      </div>
      <div class="col-sm-12 text-center">
        <form id="searchForm" class="pt-4">
          <div class="row"">
            <div class=" col-sm-12 col-md-3">
            <label for="titulo" class="form-label">Titulo:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" aria-describedby="titulo" placeholder="El Camino de los Reyes">
          </div>
          <div class="col-sm-12 col-md-3">
            <label for="autor" class="form-label">Autor:</label>
            <input type="text" class="form-control" id="autor" name="autor" aria-describedby="autor" placeholder="Brandon Sanderson">
          </div>
          <div class="col-sm-12 col-md-3">
            <label for="genero" class="form-label">Genero:</label>
            <select name="genero" class="form-select" id="genero" aria-describedby="genero">
              <option value="genero">Cualquiera</option>
              <option value="COMIC&MANGA">Comics y Mangas</option>
              <option value="FANTASIA">Fantasía</option>
              <option value="HISTORIA">Historia</option>
              <option value="NOVELA_NEGRA">Novela Negra</option>
            </select>
          </div>
          <div class="col-sm-6 col-md-1">
            <label for="puntuacion" class="form-label">Puntuación:</label>
            <select name="puntuacion" class="form-select" id="puntuacion" aria-describedby="puntuacion">
              <option value="null">^</option>
              <option value="1">1 estrella</i></option>
              <option value="2">2 estrella</i></option>
              <option value="3">3 estrella</i></option>
              <option value="4">4 estrella</i></option>
              <option value="5">5 estrella</i></option>
            </select>
          </div>
          <div class="col-sm-6 col-md-2">
            <label for="ano" class="form-label">Año:</label>
            <input type="date" class="form-control" id="ano" name="ano" aria-describedby="ano">
          </div>

          <div class="col-sm-12 my-3">
            <button type="button" class="btn btn-secondary">Buscar</button>
          </div>
      </div>
      </form>
    </div>
    <div class="col-sm-12 text-center py-3 bckColorBlue">
      <h4 class="pt-2">OTROS LIBROS DE INTERÉS</h4>
    </div>
    <div class="col-sm-12">
      <div id="allBooksContainer" class="row">

      </div>
    </div>
    </div>



  <?php
  }

  public function printFooter()
  {
  ?>

    <div class="row">
      <div class="col-sm-12 p-0">
        <footer class="bg-dark text-center text-white">
          <section class="py-4">
            <a class="btn btn-outline-light btn-floating m-1" href="https://facebook.com/" role="button"><i class="fa fa-facebook-f"></i></a>
            <a class="btn btn-outline-light btn-floating m-1" href="https://twitter.com/" role="button"><i class="fa fa-twitter"></i></a>
            <a class="btn btn-outline-light btn-floating m-1" href="https://google.com/" role="button"><i class="fa fa-google"></i></a>
            <a class="btn btn-outline-light btn-floating m-1" href="https://instagram.com/" role="button"><i class="fa fa-instagram"></i></a>
            <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/" role="button"><i class="fa fa-github"></i></a>
          </section>
          <section class="m-4">
            <p>
              Biblioteca creada por Miguel Robles Gámez para el módulo de Interfaces en el ciclo formativo de grado superior de desarrollo de aplicaciones web,
              en el año 2021.
            </p>
          </section>
          <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2021 Copyright:
            <a class="text-white" href="https://google.com/">Miguel Robles Gámez</a>
          </div>
        </footer>
      </div>
    </div>

    <?php
  }


  public function printBookBody()
  {
    //comprobar si el usuario esta registrado para mostar el añadir comentario y el alquilar libro

    if (isset($_GET["isbn"])) {

      $isbn = $_GET["isbn"];

      $book = getBook($isbn);
      $comments = getComments($isbn);
      $alquiler = isAlquiler($isbn);

      if ($book != null) {

        $titulo = $book["records"][0]["titulo"];
        $isbn = $book["records"][0]["isbn"];
        $autor = $book["records"][0]["autor"];
        $genero = $book["records"][0]["genero"];
        $sinopsis = $book["records"][0]["sinopsis"];
        $rutaimg = $book["records"][0]["rutaimg"];
        $ano = $book["records"][0]["ano"];
        $puntuacion = (int) $book["records"][0]["puntuacion"];


    ?>

        <div class="row mt-3">
          <div class="col-sm-12 text-center px-0 py-4 bckColorBlue">
            <h2 class="pt-2"><?= $titulo ?></h2>
          </div>
        </div>
        <div class="row my-5">
          <div class="col-sm-12 col-md-4 d-flex justify-content-center text-center borderImgBook">
            <img src="img/books/<?= $rutaimg ?>" alt="<?= $rutaimg ?>">
          </div>
          <div class="col-sm-12 col-md-8">
            <div class="row text-center mt-3">
              <div class="col-sm-12">
                <h3>Autor - <?= $autor ?></h3>
              </div>
              <div class="col-sm-12">
                <p class="genreBubble"><?= $genero ?></p>
                <p class="genreBubble"><?= $ano ?></p>
                <p class="genreBubble"><?= $puntuacion ?> <i class="fa fa-star" aria-hidden="true"></i></p>
              </div>
              <div class="col-sm-12">
                <p class="description mt-5"><?= $sinopsis ?></p>
              </div>

              <?php
                if (isset($_SESSION["nombre"])) {
                  if ($alquiler == null) {
                    ?>
                    <div id="containerButtonAlquiler" class="offset-sm-3 col-sm-6 py-3 alquilarContainer">
                      <p><b>Alquilar este libro 2 semanas<b></p>
                      <button class="btn btn-primary" id="buttonAlquiler">Alquilar</button>
                    </div>
                    <?php
                  } else {
                    ?>
                    <div id="containerButtonAlquiler" class="offset-sm-3 col-sm-6 py-3 alquilarContainer">
                      <p><b>Alquilar este libro 2 semanas<b></p>
                      <button class="btn btn-warning">El Libro ya esta alquilado</button>
                    </div>
                    <?php
                  }
                } else {
                  ?>
                  <div class="offset-sm-3 col-sm-6 py-3 alquilarContainer">
                    <p><b>Registrate para poder alquilar este libro<b></p>
                  </div>
                  <?php
                }
              ?>

              

              <div class="offset-sm-3"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 text-center mt-5 bckColorBlue">
            <h2 class="py-3 px-0">Comentarios</h2>
          </div>

          <?php
          if (isset($_SESSION["nombre"])) {
          ?>
            <div class="row">
              <div class="col-sm-12">

                <form id="commentForm">
                  <div class="row">
                    <div class="mb-3 col-sm-10 mt-2">
                      <label for="comentario" class="form-label">¡Comparte tu propia opinión!</label>
                      <textarea type="text" class="form-control" id="comentario" name="comentario" aria-describedby="Comentario" placeholder="Escriba su comentario aqui, evite comentar spoilers"></textarea>
                      <p id="textCommentaryHidden">No se ha podido enviar el comentario, intentalo de nuevo mas tarde</p>
                    </div>
                    <div class="mb-3 col-sm-2 mt-2">
                      <label for="puntuacion" class="form-label">Puntuación:</label>
                      <select name="puntuacionComentario" class="form-select" id="puntuacionComentario" aria-describedby="puntuacionComentario">
                        <option value="null">Seleccione</option>
                        <option value="1">1 estrella</i></option>
                        <option value="2">2 estrella</i></option>
                        <option value="3">3 estrella</i></option>
                        <option value="4">4 estrella</i></option>
                        <option value="5">5 estrella</i></option>
                      </select>
                    </div>
                    <input type="hidden" name="isbn" value="<?= $isbn ?>">
                    <div class="modal-footer">
                      <button type="button" id="submitComment" name="submitComment" class="btn btn-primary">Comentar</button>
                    </div>

                  </div>
                </form>
              </div>
            </div>
          <?php
          }
          ?>
          <div class="row mx-0 my-3 p-0">
            <?php
            if ($comments != null) {
              foreach ($comments as $comment) {
              ?>
  
                <div class="col-sm-12 pt-2 bckColorGray">
                  <h5><?= $comment["user"]["nombre"] ?>, Ha puntuado con: <?= (int) $comment["puntuacion"] ?><i class="fa fa-star" aria-hidden="true"></i></h5>
  
                  <p class="my-2"><?= $comment["comentario"] ?></p>
                </div>
  
              <?php
              }
            } else {
              ?>
                <div class="col-sm-12 pt-2 bckColorGray">
                  <h5>No hay comentarios todavía, ¡regístrate y se el primero en comentar!</h5>
                </div>
                
              <?php
            }
            ?>
          </div>
            
        </div>

<?php
      }
    } else {
      echo "<p class='mt-5'>No se ha conseguido un valor isbn, por favor intentelo más tarde</p>";
    }
  }

  
  public function printBodyUser() {

    $books = getAllBooks();
    $rentUser = getRentUser();
    
    $allBooksRented = [];

    if (sizeof($books) == 0 && sizeof($rentUser) == 0) {

    } else {
      foreach ($rentUser as $rent) {
        foreach ($books as $book ) {
          
          if ($rent["isbn"] == $book["isbn"]) {
            $book["fechainicio"] = $rent["fechainicio"];
            $book["fechafinal"] = $rent["fechafinal"];
            $book["idalquiler"] = $rent["idalquiler"];
            array_push($allBooksRented, $book);
          }
  
        }
      }
    }   


    ?>

      <div class="row mt-3">
        <div class="col-sm-12 text-center px-0 py-4 bckColorBlue">
        <h2 class="pt-2">Bienvenido <?= $_SESSION["nombre"] ?></h2>
        <h2 class="pt-2">Aqui podrás ver los libros que tienes en alquiler y devolverlos.</h2>
        </div>
      </div>
      <div class="row">
        <?php

        if (sizeof($allBooksRented) == 0) {
          ?>

          <div class="col-sm-12 d-flex py-5 my-5 justify-content-center text-center py-4">
            <h3 class="my-5 py-5 text-center">No tienes libros alquilados todavia, ¡encuentra alguno que te guste y alquílalo!</h3>
          </div>
          <div class="col-sm-12 d-flex py-2 my-2 justify-content-center text-center py-4">
            
          </div>

          <?php
        } else {
          foreach ($allBooksRented as $book) {
          
            ?>
              <div class="col-sm-6 col-md-4 d-flex justify-content-center text-center py-4">
                <div class="card">
                <img src="img/books/<?=$book["rutaimg"]?>" class="card-img-top cardImg" alt="<?=$book["rutaimg"]?>">
                <div class="card-body">
                  <h5 class="card-title"><?=$book["titulo"]?></h5>
                  <p class="card-text">Inicio del Alquiler <br><b><?=$book["fechainicio"]?></b></p>
                  <p class="card-text">Final del Alquiler <br><b><?=$book["fechafinal"]?></b></p>
                  <a class="btn btn-primary returnBook" data-id="<?=$book["idalquiler"]?>">Devolver</a>
                </div>
              </div>
              </div>
            <?php
  
          }
        }  
        
        ?>
        <div class="col-sm-12">
          <p id="errorDevolucion">No se ha podido devolver el libro, intentelo de nuevo mas tarde<p>
        </div>
      </div>
    <?php

  }

  function printAdminBody() {
    
    $books = getAllBooks();
    $users = getAllUsers();



    if (sizeof($books) != 0 || sizeof($users) != 0) {
      ?>

      <div class="row">
        <div class="col-sm-12 py-4 mt-3 text-center bckColorBlue">
          <h2>Administrador de Usuarios</h2>
        </div>
          <?php
            if (sizeof($users) > 0) {
              ?>
              <div class="row">
                <div class="col-sm-12 mt-5 text-center">
                  <table class="table">
                    <tr>
                      <th scope="col">Mail</th>
                      <th scope="col">Nick</th>
                      <th scope="col">Admin</th>
                      <th scope="col">Borrar</th>
                    </tr>
                    <?php
                    foreach ($users as $user) {
                      ?>
                      <tr>
                        <td><?=$user["mail"]?></td>
                        <td><?=$user["nombre"]?></td>
                        <td>
                          <?php
                          if ($user["administrator"] == 0) {
                            ?>
                            No
                            <?php
                          } else {
                            ?>
                            Si
                            <?php
                          }
                          ?>
                        </td>
                        <td><button type="button" class="btn btn-warning buttonDeleteUser" data-id="<?=$user["mail"]?>">Borrar Usuario</button></td>
                      </tr>
                      <?php
                    }
                  ?>
                  </table>
                  <p id="errorBorrarUser">No se ha podido borrar el usuario, inténtelo de nuevo mas tarde</p>
                </div>
                <div class="col-sm-12 my-3 text-center">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalCreateUser" class="btn btn-primary mx-2 my-md-0 my-sm-2">Crear Usuario</button>
                </div>
              </div>

              <?php
            } else {
              ?>

              <div class="row">
                <div class="col-sm-12 mt-5 text-center">
                  <h2>No hay usuarios registrados</h2>
                </div>
                <div class="col-sm-12 my-3 text-center">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalCreateUser" class="btn btn-primary mx-2 my-md-0 my-sm-2">Crear Usuario</button>
                </div>
              </div>

              <?php
            }
          ?>
      </div>
      <div class="row">
        <div class="col-sm-12 mx-0 py-4 mt-3 text-center bckColorBlue">
          <h2>Administrador de Libros</h2>
        </div>
      </div>
      <?php
            if (sizeof($books) > 0) {
              ?>
              <div class="row">
                <div class="col-sm-12 mt-5 text-center">
                  <table class="table">
                    <tr>
                      <th scope="col">Img</th>
                      <th scope="col">ISBN</th>
                      <th scope="col">Título</th>
                      <th scope="col">Autor</th>
                      <th scope="col">Género</th>
                      <th scope="col">Borrar</th>
                    </tr>
                    <?php
                    foreach ($books as $book) {
                      ?>
                      <tr>
                        <td><img class="imgAdmin" src="img/books/<?=$book["rutaimg"]?>" alt="<?=$book["rutaimg"]?>"></td>
                        <td><?=$book["isbn"]?></td>
                        <td><?=$book["titulo"]?></td>
                        <td><?=$book["autor"]?></td>
                        <td><?=$book["genero"]?></td>
                        <td><button type="button" class="btn btn-warning buttonDeleteBook" data-id="<?=$book["isbn"]?>">Borrar Libro</button></td>
                      </tr>
                      <?php
                    }
                  ?>
                  </table>
                  <p id="errorBorrarBook">No se ha podido borrar el libro, inténtelo de nuevo mas tarde</p>
                  <div class="col-sm-12 my-3 text-center">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalCrearLibro" class="btn btn-primary mx-2">Crear Libro</button>
                  </div>
                </div>
              </div>

              <?php
            } else {
              ?>

              <div class="row">
                <div class="col-sm-12 mt-5 text-center">
                  <h2>No hay libros disponible actualmente</h2>
                </div>
              </div>

              <?php
            }
          ?>
          <div class="modal fade" id="modalCreateUser" tabindex="-1" aria-labelledby="modalCreateUserLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalCreateUserLabel">Crear Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <form id="createUserForm">
                    <div class="mb-3">
                      <label for="nombreNewUser" class="form-label">Nick:</label>
                      <input type="text" class="form-control" id="nombreNewUser" name="nombreNewUser" aria-describedby="nombreNewUser" placeholder="hola1234">
                    </div>
                    <div class="mb-3">
                      <label for="mailNewUser" class="form-label">Email:</label>
                      <input type="email" class="form-control" id="mailNewUser" name="mailNewUser" aria-describedby="mailNewUser" placeholder="ejemplo@ejemplo.com">
                    </div>
                    <div class="mb-3">
                      <label for="contrasena" class="form-label">Contraseña</label>
                      <input type="password" class="form-control" id="contrasena" aria-describedby="contrasena" name="contrasena">
                    </div>
                    <div class="mb-3 form-group">
                      <label for="privileges" class="form-label">Admin</label>
                      <select class="form-select" name="privileges" id="privileges" aria-describedby="privileges">
                        <option selected value="0">No</option>
                        <option value="1">Si</option>
                      </select>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                      <button type="button" id="createUser" class="btn btn-primary">Crear Usuario</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modalCrearLibro" tabindex="-1" aria-labelledby="modalCrearLibroLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalCrearLibroLabel">Crear Libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <form id="createBookForm">
                    <div class="mb-3">
                      <label for="isbnNewBook" class="form-label">ISBN:</label>
                      <input type="text" class="form-control" id="isbnNewBook" name="isbnNewBook" aria-describedby="isbnNewBook" placeholder="9788416401925">
                    </div>
                    <div class="mb-3">
                      <label for="titulo" class="form-label">Título:</label>
                      <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Harry Potter y la Piedra Filosofal">
                    </div>
                    <div class="mb-3">
                      <label for="autor" class="form-label">Autor:</label>
                      <input type="text" class="form-control" id="autor" name="autor" placeholder="J.K.Roling">
                    </div>
                    <div class="mb-3">
                      <label for="fechaSalida" class="form-label">Año de Salida:</label>
                      <input type="text" class="form-control" id="fechaSalida" name="fechaSalida" placeholder="2010">
                    </div>
                    <div class="mb-3">
                      <label for="genero" class="form-label">Género:</label>
                      <select class="form-select" name="genero" id="genero" aria-describedby="privileges">
                        <option value="COMIC&MANGA">Comics y Mangas</option>
                        <option value="FANTASIA">Fantasía</option>
                        <option selected value="HISTORIA">Histórico</option>
                        <option value="NOVELA_NEGRA">Novela Negra</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="sinopsis" class="form-label">Sinopsis:</label>
                      <textarea name="sinopsis" class="form-control" id="sinopsis"></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="rutaimg" class="form-label">Ruta de la IMG:</label>
                      <input type="text" class="form-control" id="rutaimg" name="rutaimg" placeholder="imagen.jpg">
                    </div>
                    <input type="hidden" name="puntuacion" value="5">
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                      <button type="button" id="createBook" class="btn btn-primary">Crear Libro</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
    }

  }

}
?>