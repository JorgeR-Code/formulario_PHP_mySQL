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
    <div class="container">
        <div class="successful">
        <form id="form1" name="form1" method="post" action="visualizar.php">
            <label for="clave_c">Buscar por clave</label>
            <input class="input" type="text" name="clave_c" id="clave_c" required>
            <button class="buscar" type="submit" name="buscar" id="buscar">Buscar</button>
        </form>
        <p><button class="button" onclick="window.location.href='index.php'">Cancelar</button></p>
        </div>
    </div>
</body>
</html>