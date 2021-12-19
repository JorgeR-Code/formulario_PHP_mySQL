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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

  $pasatiempos = implode(',', $_POST['pasatiempos']);

  $insertSQL = sprintf("INSERT INTO alumno (id, clave, nombre, apellido, edad, especialidad, genero, pasatiempos) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
                       GetSQLValueString($_POST['clave'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['edad'], "int"),
                       GetSQLValueString($_POST['especialidad'], "text"),
                       GetSQLValueString($_POST['genero'], "text"),
                       GetSQLValueString($pasatiempos, "text"));

  mysql_select_db($database_alumnos, $alumnos);
  $Result1 = mysql_query($insertSQL, $alumnos) or die(mysql_error());

  $insertGoTo = "correcto.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumno</title>
    <link href="css/styles.css" rel="stylesheet" />

</head>
<body>

<div class="container">
  <div class="card">
    <div class="conexion">
    <?php echo $conexion ?>
    </div>

      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      <table >
        <tr>
          
          <td><input type="text" name="id" value="" size="32" hidden="true"></td>
        </tr>
        <tr>
          <td >Clave:</td>
          <td><input type="text" name="clave" value="" size="32" required></td>
        </tr>
        <tr>
          <td >Nombre:</td>
          <td><input type="text" name="nombre" value="" size="32" required></td>
        </tr>
        <tr>
          <td >Apellido:</td>
          <td><input type="text" name="apellido" value="" size="32" required></td>
        </tr>
        <tr>
          <td >Edad:</td>
          <td><input type="number" name="edad" value="" size="32" min="10" max="80" required></td>
        </tr>
        <tr>
          <td >Género:</td>
          <td><table>
            <tr>
              <td><input type="radio" name="genero" value="Femenino" required>
                Femenino</td>
            
              <td><input type="radio" name="genero" value="Masculino" required>
                Masculino</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td >Especialidad:</td>
          <td><select class="" name="especialidad" required>
            <option value="Tec. Programación" <?php if (!(strcmp("Tec. Programación", ""))) {echo "SELECTED";} ?>>Tec. Programación</option>
            <option value="Prod. Prendas" <?php if (!(strcmp("Prod. Prendas", ""))) {echo "SELECTED";} ?>>Prod. Prendas</option>
            <option value="Tec. Mantenimiento" <?php if (!(strcmp("Tec. Mantenimiento", ""))) {echo "SELECTED";} ?>>Tec. Mantenimiento</option>
          </select></td>
        </tr>
        
        <tr>
          <td >Pasatiempos:</td>
          <td><table>
            <tr>
              <td><input type="checkbox" name="pasatiempos[]" value="Leer" >
                Leer</td>
              <td><input type="checkbox" name="pasatiempos[]" value="Videojuegos" >
                Videojuegos</td>
            </tr>
            
            <tr>
              <td><input type="checkbox" name="pasatiempos[]" value="Cocinar" >
                Cocinar</td>
              <td><input type="checkbox" name="pasatiempos[]" value="Música" >
                Música</td>
            </tr>
            <tr>
              <td><input type="checkbox" name="pasatiempos[]" value="Peliculas" >
                Peliculas</td>
              <td><input type="checkbox" name="pasatiempos[]" value="Gimnasio" >
                Gimnasio</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td >&nbsp;</td>
          <td>
            <button class="button2" name="Submit" type="submit">Aceptar</button>
            <button class="button2" name="Reset" type="reset" onclick="window.location.href='index.php'">Cancelar</button>
          </td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1">
    </form>
  </div>
  <div class="foto">
    <img src="images/perfil.jpeg">
  </div>

</div>

</body>
</html>