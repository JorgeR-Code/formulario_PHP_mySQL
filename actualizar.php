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

// actualizar
$updateFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $updateFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

  $clave = $_POST['clave'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $edad = $_POST['edad'];
  $especialidad = $_POST['especialidad'];
  $genero = $_POST['genero'];
  // $pasatiempos = implode(',', $_POST['pasatiempos']);
  $pasatiempos = $_POST['pasatiempos'];

  $insertSQL = sprintf("UPDATE alumno SET nombre= '$nombre', apellido= '$apellido', edad= '$edad', especialidad= '$especialidad', genero= '$genero', pasatiempos= '$pasatiempos' WHERE clave = '$clave' ");

  mysql_select_db($database_alumnos, $alumnos);
  $Result1 = mysql_query($insertSQL, $alumnos) or die(mysql_error());

  $insertGoTo = "actualizacionEx.php";
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
    <title>Document</title>
    <link href="css/styles.css" rel="stylesheet" />

</head>
<body>
  <div class="container visualizar">

  <div class="card">
  <div class="conexion  mb-8">
    <?php echo $conexion ?>
    </div>
      <form method="post" name="form1" action="<?php echo $updateFormAction; ?>">
      <table >
        <tr>
          <td >Clave:</td>
          <td><input name="clave" type="text" value="<?php echo $row_Buscar['clave']; ?>" size="32" readonly></td>
        </tr>
        <tr>
          <td >Nombre:</td>
          <td><input name="nombre" type="text" value="<?php echo $row_Buscar['nombre']; ?>" size="32" required></td>
        </tr>
        <tr>
          <td >Apellido:</td>
          <td><input name="apellido" type="text" value="<?php echo $row_Buscar['apellido']; ?>" size="32" required></td>
        </tr>
        <tr>
          <td >Edad:</td>
          <td><input name="edad" type="number" value="<?php echo $row_Buscar['edad']; ?>" size="32" min="10" max="80" required></td>
        </tr>
        <tr>
        <?php $valor2 = $row_Buscar['genero'];?>

          <td >Género:</td>
          <td>
            <select name="genero" id="genero" placeholder="selecciona el género" required>
              <option value= "<?php echo $valor2 ?>" <?php if (!(strcmp( "$valor2", ""))) {echo "SELECTED";} ?> selected hidden><?php echo $valor2 ?></option>
              <option value="Femenino" <?php if (!(strcmp("Femenino", ""))) {echo "SELECTED";} ?> >Femenino</option>
              <option value="Masculino" <?php if (!(strcmp("Masculino", ""))) {echo "SELECTED";} ?> >Masculino</option>
            </select>
          </td>
        </tr>
        <tr>
        <?php $valor = $row_Buscar['especialidad'];?>

          <td >Especialidad:</td>
          <td>
            <select name="especialidad" id="especialidad" placeholder="selecciona la especialidad" required>
                <option value= "<?php echo $valor ?>" <?php if (!(strcmp( "$valor", ""))) {echo "SELECTED";} ?> selected hidden><?php echo $valor ?></option>
                <option value="Tec. Programación" <?php if (!(strcmp("Tec. Programación", ""))) {echo "SELECTED";} ?>>Tec. Programación</option>
                <option value="Prod. Prendas" <?php if (!(strcmp("Prod. Prendas", ""))) {echo "SELECTED";} ?>>Prod. Prendas</option>
                <option value="Tec. Mantenimiento" <?php if (!(strcmp("Tec. Mantenimiento", ""))) {echo "SELECTED";} ?>>Tec. Mantenimiento</option>

            </select>
          </td>
        </tr>
        
        <tr>
          <td >Pasatiempos:</td>
          <td>
            <input name="pasatiempos" type="text" value="<?php echo $row_Buscar['pasatiempos']; ?>" size="32">
          </td>
        </tr>
        <tr>
          <td >&nbsp;</td>
          <td>
            <button class="button2" name="Submit" type="submit">Guardar</button>
            <button class="button2" name="Reset" type="reset" onclick="window.location.href='index.php'">Cancelar</button>
          </td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1">
    </form>
  </div>
  </div>

</body>
</html>
<?php
mysql_free_result($Buscar);
?>
