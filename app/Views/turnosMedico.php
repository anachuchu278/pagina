<head>
    <title>Turnos del Medico</title>
    <link rel="stylesheet" href="<?= base_url('css/turnosMedico.css')?>">
</head>
<h1>Turnos del Médico</h1>

<?php foreach ($turnosPorDia as $dia => $turnos): ?>
    <h2><?= date('d/m/Y') ?> - <?= $diasSemana[date('N')] ?></h2> 
    <a href="<?php echo base_url('medico/' . session()->get('user_id')) ?>">Volver</a>
    <table class="table">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Estado</th>
                <th>Hora del Turno</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($turnos as $turno): ?>
                <tr>
                    <td><?= esc($turno['Paciente']) ?></td>
                    <td><?= esc($turno['estado']) ?></td>
                    <td><?= date('d/m/Y g:i A', strtotime($turno['fecha_turno'])) ?></td>
                    <td>
                    <form action="<?= base_url('cancelarTurnos') ?>" method="post">
                    <input type="hidden" name="id_turno" value="<?= esc($turno['id_Turno']) ?>">
                    <button type="submit" class="btn btn-danger">Cancelar Turno</button>
                    </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endforeach; ?>

