<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <link rel="stylesheet" href="<?= base_url('css/paginaMain.css')?>">
</head>

<body>
    <div class="box">
    <nav>
        <ul class="menu-horizontal">
            <li>
                <a href="">Gestion</a>
                <ul class="menu-vertical">
                    <li><a href="">Turnos</a></li>
                    <li><a href="">Generar un turno</a></li>
                    <li><a href="">Añadir un Paciente</a></li>
                </ul>
            </li>
            <li><a href="">Perfil</a></li>
            <li><a href="">Preguntas Frecuentes</a></li> 
            <li><a href="<?= base_url('logout')?>">Cerrar Sesion</a></li> 
            <?php if ($showAdmin):?>
            <li><a class="" href="<?= site_url('vistaAdmin') ?>">Admin</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    </div>
    <div class="img">
        <img src="<?= base_url('fondo.jpg')?>" alt="">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>