<!DOCTYPE html>
<html>
<head>
    <title>Agregar Horario</title>
</head>
<body>
    <h1>Agregar Horario del Médico</h1>
    <?php
        $mindate = date("Y-m-d");
        $mintime = date("H:i");  // Usar 24 horas para compatibilidad
        $min = $mindate . "T" . $mintime;
        $maxdate = date("Y-m-d", strtotime("+120 days"));
        $maxtime = date("H:i");
        $max = $maxdate . "T" . $maxtime;
    ?>
    <form action="<?= site_url('guardarH') ?>" method="post">
        <?= csrf_field() ?>
        
        <label for="doctor_id">Seleccionar Médico:</label>
        <select name="doctor_id" id="doctor_id" required>
            <?php foreach ($medicos as $medico): ?>
                <option value="<?= esc($medico['id_Usuario']) ?>"><?= esc($medico['nombre']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="day">Día de la Semana:</label>
        <select name="day" id="day" required>
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miercoles">Miércoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
        </select><br><br>

        <label for="start_time">Hora de Inicio:</label>
        <input type="time" id="start_time" name="start_time" required value="<?= old('start_time') ?>"><br><br>

        <label for="end_time">Hora Final:</label>
        <input type="time" id="end_time" name="end_time" required value="<?= old('end_time') ?>"><br><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
