<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<link rel="stylesheet" href="<?= base_url('css/turnoVista.css'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
<title>Turnos</title>
</head>

<body>
    <form class="search" style="margin-top: 100px;" method="POST" action="<?= base_url('search') ?>">
        <input type="number" placeholder="Ingrese un DNI..." id="search" name="search" aria-label="Search">
        <button class="box-new" type="submit">Buscar</button>
    </form>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
	<?php endif; ?>
    <?php //var_dump($turnos);
    ?>
    <?php //var_dump($usuarios);
    ?>
    <?php //var_dump($horarios);
    ?>
    <?php if (!empty($turnos)): ?>
        <table style="margin-top: 10px;">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Medico</th>
                    <th>Paciente</th>
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
                                <?php if ($horario['id_Horario'] == $turno['id_Horario']) : ?>
                                    <td><?= $horario['dia_sem']; ?> | <?= $horario['hora_inicio']; ?> - <?= $horario['hora_final']; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <td><?= $turno['estado']; ?></td>
                        <td><?= $usuariosTurno[$turno['id_Usuario']]['nombre']; ?></td>
                        <td><?= $turno['paciente'];?></td> 
                        
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
