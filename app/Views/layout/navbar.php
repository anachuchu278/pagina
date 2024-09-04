<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<ul class="nav nav-tabs custom-navbar">
    <li class="nav-item">
        <a class="nav-link text-white " aria-current="page" href="<?= site_url('crudPaciente') ?>">Tus turnos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white " href="<?= site_url('calendario') ?>">Calendario</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white " href="<?= site_url('preguntas') ?>">Preguntas</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white " href="<?= site_url('perfil') ?>">Perfil</a>
    </li> 
    <li class="nav-item">
        <a class="nav-link text-white " href="<?= site_url('logout') ?>">Cerrar Sesion</a>
    </li> 
    <?php if ($showAdmin):?>
        <li><a class="nav-link text-white " href="<?= site_url('vistaAdmin') ?>">Admin</a></li>
    <?php endif; ?>
</ul> 
