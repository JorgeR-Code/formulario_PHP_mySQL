<?php require_once('Connections/alumnos.php'); ?>
<?php

$clave_alum = $_POST['clave_c'];
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_alumnos, $alumnos);
$query_Buscar = "SELECT * FROM alumno WHERE clave = '$clave_alum'";
$Buscar = mysql_query($query_Buscar, $alumnos) or die(mysql_error());
$row_Buscar = mysql_fetch_assoc($Buscar);
$totalRows_Buscar = mysql_num_rows($Buscar);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/table.css" rel="stylesheet" />

</head>
<body>
  <div class="container visualizar">
  <div class="conexion  mt-8">
    <?php echo $conexion ?>
  </div>
  <div class="successful">
      <p>Registro encontrado</p>
  </div>
  <table>
    <thead>
      <tr>
         <th>Clave</th>
         <th>Nombre</th>
         <th>Apellido</th>
         <th>Edad</th>
         <th>Especialidad</th>
         <th>Género</th>
         <th>Pasatiempos</th>
      </tr>
    </thead>
                                    
    <tbody>
        <tr>
          <td><?php echo $row_Buscar['clave']; ?></td>
          <td><?php echo $row_Buscar['nombre']; ?></td>
          <td><?php echo $row_Buscar['apellido']; ?></td>
          <td><?php echo $row_Buscar['edad']; ?></td>
          <td><?php echo $row_Buscar['especialidad']; ?></td>
          <td><?php echo $row_Buscar['genero']; ?></td>
          <td><?php echo $row_Buscar['pasatiempos']; ?></td>
          
          <td>
            <form action="actualizar.php" method="post">
              <input type="text" name="clave_c" value="<?php echo $row_Buscar['clave']; ?>" hidden/>
                <button class="actualizar" type="submit" >
                  Actualizar
                </button>
            </form>
                                                                               
          </td>
          <td >
            <form id="form2" name="form2" method="post" action="eliminado.php">
              <input type="text" name="eliminar_c" value="<?php echo $row_Buscar['clave']; ?>" hidden>
              <button class="eliminar" type="submit" name="eliminar" id="eliminar">Eliminar</button>
            </form>
          </td>
        </tr>
                                        
  </tbody>
                                    
</table>


<p><button class="button" onclick="window.location.href='buscar.php'">Volver</button></p>
  </div>

</body>
</html>
<?php
mysql_free_result($Buscar);
?>
