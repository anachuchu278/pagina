<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= base_url('css/crudMedico.css') ?>">
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
            <div class="volver-container">
            <a class="volver" href="pagina">Volver</a>
            </div>
            <?php foreach ($medicos as $medico): ?>
                <tr>
                    <td><?= $medico['nombre']; ?></td>
                    <td><?= $medico['email']; ?></td>
                    <td>
                        <?php if (!empty($horarios)): ?>
                            <?php foreach ($horarios as $horario): ?>
                                <?php if ($horario['id_usuario'] == $medico['id_Usuario']): ?>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-target="false" aria-expanded="false">
                                            <?= $horario['dia_sem']; ?> | <?= substr($horario['hora_inicio'], 0, -3); ?>-<?= substr($horario['hora_final'], 0, -3); ?>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="<?= site_url('horario_medico/' . $horario['id_Horario']); ?>">Editar</a></li>
                                            <li><a class="dropdown-item" href="<?= site_url('eliminarHorario/' . $horario['id_Horario']); ?>">Eliminar</a></li>
                                            <li><a class="dropdown-item" href="<?= site_url('horario_medico'); ?>">Nuevo Horario</a></li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <a class="btn btn-primary" role="button" href="<?= base_url('horario_medico'); ?>">Nuevo Horario</a>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <form action="<?= site_url('admin/deleteMed') ?>" method="post">
                            <input type="hidden" name="id_Usuario" value="<?= $medico['id_Usuario'] ?>">
                            <button class="noselect"><span class="text">Delete</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
                                    </svg></span></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="box-new">
        <a class="btn btn-success" href="formMedico">Añadir</a><br>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>

</html>