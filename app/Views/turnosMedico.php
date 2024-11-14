
<h1>Turnos del Médico</h1>

<?php foreach ($turnosPorDia as $dia => $turnos): ?>
    <?php var_dump($turnos); ?>
    <h2><?= date('d/m/Y', strtotime($dia)) ?> - <?= $diasSemana[date('N', strtotime($dia))] ?></h2>
    <table class="table">
        <thead>
            <tr>
                <th>Hora del Turno</th>
                <th>Horario del Médico</th>
                <th>Paciente</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($turnos as $turno): ?>
                <tr>
                    <td><?= date('H:i', strtotime($turno['id_Horario'])) ?></td>
                    
                    <td><?= esc($turno['Paciente']) ?></td>
                    <td><?= esc($turno['estado']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endforeach; ?>

