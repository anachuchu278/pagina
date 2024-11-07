<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<nav>
    <ul class="menu-horizontal">

        <a href="pagina"><i class="fa-solid fa-house-medical"></i></a>
        <li>
            <a href="">Gestion</a>
            <ul class="menu-vertical">
                <li><a href="turnos">Turnos</a></li>
                <li><a href="newTurno">Generar un turno</a></li>
                <li><a href="newPacienteView">Añadir un Paciente</a></li>
            </ul>
        </li>
        <li><a href="perfil">Perfil</a></li>
        <li><a href="<?= base_url('logout') ?>">Cerrar Sesion</a></li>
        <?php if ($showAdmin): ?>
            <li>
                <a href="">Administración</a>
                <ul class="menu-vertical">
                    <li><a href="<?= site_url('vistaAdmin') ?>">Admin</a></li>
                    <li><a href="crudMeds">Medicos</a></li>
                    <li><a href="crudPaciente">Pacientes</a></li>
                <?php endif; ?>
            </li>
        <?php if ($showMedico): ?>
            <li><a href="<?php echo base_url('medico/' . session()->get('user_id')) ?>">Medico</a></li>
        <?php endif; ?>
</nav>