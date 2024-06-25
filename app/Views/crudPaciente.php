<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= base_url('css/crud.css')?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de pacientes</title>
</head>
<body>
    <nav>
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
                        <td><?= $paciente['id_tipo_sangre']; ?></td>
                        <td><?= $paciente['RH_tipo_sangre']; ?></td>
                        <td><?= $paciente['id_obra']; ?></td>
                        <td><?= $paciente['id_usuario']; ?></td>
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
        <?php if ($showAdmin): ?>
            <li><a href="admin">Admin</a></li>
        <?php else: ?>
        <?php endif; ?>
    </body>
</html>