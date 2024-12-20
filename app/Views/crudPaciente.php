<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= base_url('css/crudPaciente.css')?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <title>Registro de pacientes</title>
</head>
<body>
    <table style="margin: 100px auto;">
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
                    <td><?php $dni= $paciente['dni']; strval($dni); echo number_format($dni ,0 , ',' ,'.'); ?></td>
                    <td><?= $paciente['nombre']; ?></td>
                    <td><?= $paciente['apellido']; ?></td>
                    <td><?= $paciente['edad']; ?></td>
                    <td><?= $paciente['altura_cm']; ?></td>
                    <td><?= $paciente['tipo_sangre']; ?></td>
                    <td><?= $paciente['RH_tipo_sangre']; ?></td>
                    <td><?= $paciente['obra_nombre']; ?></td>
                    <td><?= $paciente['usuario_email']; ?></td>
                    <td>
                        
                        
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