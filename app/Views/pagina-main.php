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
    <div class="imagen">
        <img src="img/1.jpg" alt="" >
    </div><br>
    <div class="container center-screen">
        <div class="row justify content-center">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Generar un Turno</h5>
                        <p class="card-text">Toque aqui para generar un turno.</p>
                        <a href="<?php echo base_url('newTurno')?>" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Añadir un Paciente</h5>
                        <p class="card-text">Añada aqui sus datos personales.</p>
                        <a href="<?php echo base_url('newPacienteView')?>" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Ver mis Turnos</h5>
                        <p class="card-text">Vea los turnos generados.</p>
                        <a href="<?php echo base_url('turnos')?>" class="btn btn-primary">Ir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>