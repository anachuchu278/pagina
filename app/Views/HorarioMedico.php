<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="<?= base_url('css/editPaciente.css')?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <form action="<?= isset($usuario['id_Usuario']) ? base_url('guardarH/' . $usuario['id_Usuario']) : base_url('guardarH') ?>" method="post">
        <?= csrf_field() ?>
        <?php if (isset($usuario['id_Usuario'])): ?>
            <input type="hidden" name="id_Usuario" value="<?= $usuario['id_Usuario'] ?>">
        <?php endif; ?>

        <label for="doctor_id">Medico:</label><br>
        <select name="doctor_id" id="doctor_id" <?= isset($usuario['id_Usuario']) ? 'disabled' : 'required' ?> onchange="checkUserRole()">
            <option value="">Seleccione un medico:</option>
            <?php foreach ($medicos as $medico): ?>
                <?php if ($medico['id_rol'] != 2): ?> <!-- Excluir usuarios con rol de administrador -->
                    <option value="<?= $medico['id_Usuario'] ?>" data-id-rol="<?= $medico['id_rol'] ?>" <?= (isset($usuario['id_Usuario']) && $usuario['id_Usuario'] == $medico['id_Usuario']) ? 'selected' : '' ?>><?= $medico['nombre'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select><br>

        <label for="day">Día de la Semana:</label>
        <select name="day" id="day" required>
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miercoles">Miércoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
        </select><br><br>
        
        <label for="start_time">Hora de Inicio:</label>
        <input type="time" id="start_time" name="start_time" required value="<?= isset($horario['hora_inicio']) ? $horario['hora_inicio'] : ''?>"><br><br>
        
        <label for="end_time">Hora Final:</label>
        <input type="time" id="end_time" name="end_time" required value="<?= isset($horario['hora_final']) ? $horario['hora_final'] : '' ?>"><br><br>
        
        <button type="submit">Guardar</button>
    </form>

    <form action="">
        <label for="horario_id">Horarios:</label><br>
        <select name="horario_id" id="horario_id" required>
            <option value="">Seleccione un horario:</option>
                <?php foreach ($horarios as $horario): ?>
                    <option value="<?= $horario['id_Horario'] ?>"><?= $horario['dia_sem'] ?>: <?= $horario['hora_inicio'] ?> - <?= $horario['hora_final'] ?></option>
                <?php endforeach; ?>
        </select><br><br>
    </form>
</body>
</html>