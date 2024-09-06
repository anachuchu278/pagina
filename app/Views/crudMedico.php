<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= base_url('css/crudPaciente.css')?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicos</title>
</head>
<body>
    
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>E-mail</th>
                <th>Horarios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($medicos as $medico): ?>
                <tr>
                    <td><?= $medico['nombre']; ?></td>
                    <td><?= $medico['email']; ?></td>
                    <td>
                        <?php foreach ($horarios as $horario): ?>
                            <?php if ($horario['id_usuario'] == $medico['id_Usuario']): ?>
                                <?= $horario['hora_inicio']; ?>-<?= $horario['hora_final']; ?><br>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <a class="editar" href="<?= site_url('horario_medico/'. $medico['id_Usuario']); ?>">Editar</a>
                        <a class="delete" href="<?= site_url('eliminarMedico/'. $medico['id_Usuario']); ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <div class="box-new">
        <a class="new" href="newMedicoView">Añadir</a><br>
    </div>
</body>
</html>
