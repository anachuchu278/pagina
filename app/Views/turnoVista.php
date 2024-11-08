<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<link rel="stylesheet" href="<?= base_url('css/turnoVista.css'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
<title>Turnos</title>
</head>

<body>
    <?php //var_dump($turnos);
    ?>
    <?php //var_dump($usuarios);
    ?>
    <?php //var_dump($horarios);
    ?>
    <?php if (!empty($turnos)): ?>
        <table>
            <thead>
                <tr>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Paciente</th>
                    <th>Medico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <title>Ver Turnos</title>
                </head>
            <tbody>
                <?php foreach ($turnos as $turno) : ?>
                    <tr>
                        <?php if (!empty($horarios)) : ?>
                            <?php foreach ($horarios as $horario) : ?>
                                <?php if ($horario['id_Horario'] == $turno['fecha_hora']) : ?>
                                    <td><?= $horario['dia_sem']; ?> | <?= $horario['hora_inicio']; ?> - <?= $horario['hora_final']; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <td><?= $turno['id_Usuario']; ?></td>
                        <td><?= $usuariosTurno[$turno['id_Usuario']]['nombre']; ?></td>
                        <td><?= $turno['paciente'];?></td> <!-- Paciente -->
                        
                        <td>
                            <a href="<?= site_url('editarTurno/' . $turno['id_Turno']); ?>">Reprogramar Turno</a>
                            <a href="<?= site_url('cancelarTurno/' . $turno['id_Turno']); ?>">Cancelar Turno</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

            </tbody>
        </table>
    <?php else: ?>
        <p class="no-turno" style="margin-top: 100px;">No tiene turnos reservados.</p>
    <?php endif; ?>
    <div class="box-new">
        <a href="newTurno"><button class="new">Pedir Turno</button></a>
    </div>
</body>

</html>