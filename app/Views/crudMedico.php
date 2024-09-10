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
    <table class="table table-striped">
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
                                <?= $horario['hora_inicio']; ?>-<?= $horario['hora_final']; ?>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="<?= site_url('horario_medico/'. $horario['id_Horario']); ?>">Editar</a></li>
                                        <li><a class="dropdown-item" href="<?= site_url('eliminarHorario/'. $horario['id_Horario']); ?>">Eliminar</a></li>
                                    </ul>
                                </div>
                                <br>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="<?= site_url('editPaciente/'. $medico['id_Usuario']); ?>">Editar</a>
                        <a class="btn btn-danger" href="<?= site_url('eliminarPaciente/'. $medico['id_Usuario']); ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <div class="box-new">
        <a class="btn btn-success" href="newMedicoView">Añadir</a><br>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzOgQpeKBmRa8N1l9K/r+7B0GR8Q0x0BSWS9aPpbbPyr" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12W8B2G5y5z2QpH1ANe1XmWl5r5Vxj1KSk8pcq5d5pVb5d5M" crossorigin="anonymous"></script>
</body>
</html>