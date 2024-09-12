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
                                <p class="d-inline-flex gap-1">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        <?= $horario['hora_inicio']; ?>-<?= $horario['hora_final']; ?>
                                    </button>
                                </p>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <a class="dropdown-item" href="<?= site_url('horario_medico/'. $horario['id_Horario']); ?>">Editar</a>
                                        <a class="dropdown-item" href="<?= site_url('eliminarHorario/'. $horario['id_Horario']); ?>">Eliminar</a>
                                    </div>
                                </div><br>
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