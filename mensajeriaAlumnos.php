<?php
require_once __DIR__ . '/include/dao/Clases.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mensajería alumnos</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
    <?php
       if (!isset($_SESSION['login']) || $_SESSION['rol'] != 'profesor'){
        header("Location: ./login.php");
      }
    ?>
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqProfesor.php");
    ?>
    <div id="contenido">
      <h1>Destinatario</h1>
      <?php
        $clase = new Clases();
        $clase->setId(htmlspecialchars(trim(strip_tags($_GET["id"]))));
        $rs = $clase->getAlumnos();

        if($rs->num_rows > 0){
          $i = 1;
          while($fila = $rs->fetch_assoc()){
            echo '<form name="myform" action="mensajeria.php" method="POST">
              <input type="hidden" name="tutor" value="' .$fila["id_tutor_legal"]. '">
              <input type="hidden" name="profesor" value="' .htmlspecialchars(trim(strip_tags($_GET["profesor"]))). '">
              <button type="submit">' .$i. '. Tutor legal de ' .$fila["nombre"]. ' ' .$fila["apellido1"]. ' ' .$fila["apellido2"]. '</button>
            </form>';
            $i = $i + 1;
          }
        }
        else{
          echo "No hay clases con id " .htmlspecialchars(trim(strip_tags($_GET["id"])));
        }
      ?>
    </div>

    <?php
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
