<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<ul class="nav nav-tabs custom-navbar" style="background-color: #50A5E4;">
    <li class="nav-item">
        <a class="nav-link text-white " aria-current="page" href="<?= site_url('pagina') ?>">Inicio</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white " aria-current="page" href="<?= site_url('turnos') ?>">Tus turnos</a>
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
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="<?= site_url('vistaAdmin') ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Admin
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item"  href="<?= site_url('vistaAdmin') ?>">Admin</a></li>
            <li><a class="dropdown-item" href="<?= site_url('crudMeds') ?>">Medicos</a></li>
            <li><a class="dropdown-item" href="<?= site_url('crudPaciente') ?>">Pacientes</a></li>
        </ul>
    </li>
    <?php endif; ?>
</ul> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>