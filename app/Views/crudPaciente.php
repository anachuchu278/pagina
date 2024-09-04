<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= base_url('css/crudPaciente.css')?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de pacientes</title>
</head>
<body>
    <nav>
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
            <li><a class="nav-link text-white " href="<?= site_url('crudMeds') ?>">Medicos</a></li>
            <li><a class="nav-link text-white " href="<?= site_url('vistaAdmin') ?>"></a></li>
        <?php endif; ?>    
    </ul> 
    </nav>
    <table>
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Altura(cm)</th>
                <th>Tipo de sangre</th>
                <th>RH</th>
                <th>Obra</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pacientes as $paciente): ?>
                <tr>
                    <td><?= $paciente['dni']; ?></td>
                    <td><?= $paciente['nombre']; ?></td>
                    <td><?= $paciente['apellido']; ?></td>
                    <td><?= $paciente['edad']; ?></td>
                    <td><?= $paciente['altura_cm']; ?></td>
                    <td><?= $paciente['tipo_sangre']; ?></td>
                    <td><?= $paciente['RH_tipo_sangre']; ?></td>
                    <td><?= $paciente['obra_nombre']; ?></td>
                    <td><?= $paciente['usuario_email']; ?></td>
                    <td>
                        <a class="editar" href="<?= site_url('editPaciente/'. $paciente['id_Paciente']); ?>">Editar</a>
                        <a class="delete" href="<?= site_url('eliminarPaciente/'. $paciente['id_Paciente']); ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="box-new">
        <a class="new" href="newPacienteView">Añadir</a><br>
    </div>
</body>
</html>