<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC personas</title>
    <link rel="stylesheet" href="vista/css/app.css">
</head>
<body>
   <div class="panel">
       <h1 class="text-center">E-COSECHA</h1>
       <li class="cerrar-sesion">
                <a href="includes/logout.php">Cerrar sesión</a>
            </li>
        </ul>   
       <!-- contenido-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Aplicación MVC</title>
    <link rel="stylesheet" href="vista/css/app.css"> <!-- Asegúrate de ajustar la ruta a tu archivo CSS -->
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a  class="btn" name="btn" href="index.php">Cosecha</a></li>
                <li><a  class="btn" name="btn" href="index.php?m=persona&a=index">Persona</a></li>
                <li><a  class="btn" name="btn" href="index.php?m=trabajador&a=index">Trabajador</a></li>
                <li><a href="/mvc/vista/tarja/nuevo.php">Ingresar Tarja</a></li>
                <li><a href="index.php?m=trabajador&a=cajas" class="btn">Ver Listado de Cosecheros</a></li>
                <!-- Agrega más enlaces según sea necesario -->
            </ul>
        </nav>
    </header>
    <div class="container">