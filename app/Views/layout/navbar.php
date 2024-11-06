<head>
    <link rel="stylesheet" href="<?= base_url('css/navbar.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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