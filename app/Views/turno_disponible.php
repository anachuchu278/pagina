<!DOCTYPE html>
<html>
<head>
    <title>Horarios Disponibles</title>
</head>
<body>
    <h1>Horarios Disponibles de Médicos</h1>

    <?php foreach ($medicos as $medico): ?>
        <h2><?= esc($medico['nombre']) ?></h2>
        <?php if (isset($horarios[$medico['id_Usuario']])): ?>
            <ul>
                <?php foreach ($horarios[$medico['id_Usuario']] as $dia_sem => $Hor): ?>
                    <li>
                        <strong><?= esc($dia_sem) ?>:</strong>
                        <ul>
                            <?php foreach ($Hor as $horario): ?>
                                <?php foreach ($horario as $slot): ?>
                                    <li>
                                        <strong><?= esc($slot['start']) ?> - <?= esc($slot['end']) ?></strong>
                                    </li>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No hay horarios disponibles para este médico.</p>
        <?php endif; ?>
    <?php endforeach; ?>
</body>
</html>
