<head>
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
            <td><?= isset($usuariosTurnos[$turno['id_Usuario']]) ? $usuariosTurnos[$turno['id_Usuario']]['nombre'] : 'Usuario no encontrado'; ?></td>
            <td>
                <a href="<?= site_url('editarTurno/' . $turno['id_Turno']); ?>">Reprogramar Turno</a>
                <a href="<?= site_url('cancelarTurno/' . $turno['id_Turno']); ?>">Cancelar Turno</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
