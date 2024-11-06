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
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= base_url('css/turnoVista.css');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
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
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Medico</th>
                    <th>Paciente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($turnos as $turno) :?>
                    <tr>
                        <td><?= $turno['estado'];?></td>
                        <?php if (!empty($horarios)):?>
                        <?php foreach($horarios as $horario):?>
                            <?php if($horario['id_Horario'] == $turno['fecha_hora']):?>
                                <td><?= $horario['dia_sem']; ?> | <?= substr($horario['hora_inicio'],0,-3);?> - <?= substr($horario['hora_final'],0,-3); ?></td>
                            <?php endif;?>
                        <?php endforeach;?>
                        <?php endif;?>
                        <td><?= $turno['paciente'];?></td> <!-- Paciente -->
                        <td><?= $usuariosTurno[$turno['id_Usuario']]['nombre']; ?></td> <!-- Medico -->
                        <td>
                            <a href="<?= site_url('editarTurno/'. $turno['id_Turno']); ?>">Reprogramar Turno</a>
                            <a href="<?= site_url('cancelarTurno/'. $turno['id_Turno']); ?>">Cancelar Turno</a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            <?php endif; ?>

            <td><?= $turno['id_usuario']; ?></td>
            <td><?= isset($usuariosTurnos[$turno['id_usuario']]) ? $usuariosTurnos[$turno['id_Usuario']]['nombre'] : 'Usuario no encontrado'; ?></td>
            <td>
                <a href="<?= site_url('editarTurno/' . $turno['id_Turno']); ?>">Reprogramar Turno</a>
                <a href="<?= site_url('cancelarTurno/' . $turno['id_Turno']); ?>">Cancelar Turno</a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
