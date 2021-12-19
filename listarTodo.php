<?php require_once('Connections/alumnos.php'); ?>
<?php
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
$query_Recordset1 = "SELECT * FROM alumno";
$Recordset1 = mysql_query($query_Recordset1, $alumnos) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
      <p>Listado de registros</p>
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
      <?php do { ?>
        <tr>
          <td><?php echo $row_Recordset1['clave']; ?></td>
          <td><?php echo $row_Recordset1['nombre']; ?></td>
          <td><?php echo $row_Recordset1['apellido']; ?></td>
          <td><?php echo $row_Recordset1['edad']; ?></td>
          <td><?php echo $row_Recordset1['especialidad']; ?></td>
          <td><?php echo $row_Recordset1['genero']; ?></td>
          <td><?php echo $row_Recordset1['pasatiempos']; ?></td>
          
          <td>
            <form action="actualizar.php" method="post">
              <input type="text" name="clave_c" value="<?php echo $row_Recordset1['clave']; ?>" hidden/>
                <button class="actualizar" type="submit" >
                  Actualizar
                </button>
            </form>
                                                                               
          </td>
          <td >
            <form id="form2" name="form2" method="post" action="eliminado.php">
              <input type="text" name="eliminar_c" value="<?php echo $row_Recordset1['clave']; ?>" hidden>
              <button class="eliminar" type="submit" name="eliminar" id="eliminar">Eliminar</button>
            </form>
          </td>
        </tr>
                                        
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </tbody>
                                    
</table>
<p><button class="button" onclick="window.location.href='index.php'">Volver</button></p>
  </div>


</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
