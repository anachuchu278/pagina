<?php
$is_logged = 0;
$user = session('user');
if (null !== $user) {
  $is_logged = (session('user')['id_usuario'] > 0);
} 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Tus turnos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('calendario') ?>">Calendario</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Consulta</a>
        </li>
        <li class="nav-item position-relative">
            <a class="nav-link" href="#">Perfil</a>
        </li>

        <!-- //Apartado para rol de medico  -->
        <!-- <li class="nav-item ">
            <a class="nav-link" href="#">Ver mis turnos</a>
        </li>  --> 

         <!-- //Apartado para rol Admin  -->
        <!-- <li class="nav-item ">
            <a class="nav-link" href="#">Gestion de Turnos</a>
        </li>  
        <li class="nav-item ">
            <a class="nav-link" href="#">Gestionar Usuarios Usuarios</a> 
        </li>  
        -->
    </ul> 



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>