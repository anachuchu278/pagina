<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= base_url('css/turnoVista.css');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnos</title>
</head>
<body>
    <?php //var_dump($turnos);?>
    <?php //var_dump($usuarios);?>
    <?php //var_dump($horarios);?>
    <?php if (!empty($turnos)): ?>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Medico</th>
                    <th>Paciente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($turnos as $turno) :?>
                    <tr>
                        <?php if (!empty($horarios)):?>
                        <?php foreach($horarios as $horario):?>
                            <?php if($horario['id_Horario'] == $turno['fecha_hora']):?>
                                <td><?= $horario['dia_sem']; ?> | <?= $horario['hora_inicio'];?> - <?= $horario['hora_final']; ?></td>
                            <?php endif;?>
                        <?php endforeach;?>
                        <?php endif;?>
                        <td><?= $turno['id_Usuario']; ?></td>
                        <td><?= $usuariosTurno[$turno['id_Usuario']]['nombre']; ?></td>
                        <td>
                            <a href="<?= site_url('editarTurno/'. $turno['id_Turno']); ?>">Reprogramar Turno</a>
                            <a href="<?= site_url('cancelarTurno/'. $turno['id_Turno']); ?>">Cancelar Turno</a>
                            <!-- <a href="<?= site_url('PDFTurno/'. $turno['id_Turno']); ?>">Descargar PDF</a> -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No tiene turnos reservados.</p>
    <?php endif; ?>
    <div class="box-new">
        <a href="newTurno"><button class="new" >Pedir Turno</button></a>
    </div>
</body>
</html>
