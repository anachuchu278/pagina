<form action="<?= base_url('turnoDisp') ?>" method="POST">
    <label for="id_Medico">Seleccione un médico:</label>
    <select class="form-select" name="id_Medico" id="id_Medico" required>
        <option value="">Seleccione un médico</option>
        <?php foreach ($medicos as $medico): ?>
            <option value="<?= $medico['id_Usuario'] ?>" <?= ($id_Medico == $medico['id_Usuario']) ? 'selected' : '' ?>>
                <?= $medico['nombre']; ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label for="fecha_turno">Seleccione la fecha:</label>
    <input type="date" id="fecha_turno" name="fecha_turno" value="<?= $fecha_turno; ?>" required><br>

    <button type="submit" class="btn btn-primary">Ver turnos disponibles</button>
</form>

<?php if (!empty($horarios_disponibles)): ?>
    <h3>Turnos disponibles:</h3>
    <ul>
        <?php foreach ($horarios_disponibles as $horario): ?>
            <li><?= $horario['dia_sem']; ?> - <?= substr($horario['hora_inicio'], 0, -3); ?> - <?= substr($horario['hora_final'], 0, -3); ?></li>
        <?php endforeach; ?>
    </ul>
<?php elseif ($fecha_turno && $id_Medico): ?>
    <p>No hay turnos disponibles para la fecha seleccionada.</p>
<?php endif; ?>