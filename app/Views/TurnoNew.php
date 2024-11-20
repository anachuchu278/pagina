<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo base_url('css/editPaciente.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <title>Nuevo Turno</title>
</head>

<body>
    <!-- <a href="<?php echo base_url('pagina') ?>" class="boton-volver">Volver</a> -->
    <form action="newTurno1" method="POST">
        <label for="id_Medico">Medico:</label><br>
        <select class="form-select" name="id_Medico" id="id_Medico" required>
            <option value="">Seleccione un medico</option>
            <?php foreach ($medicos as $medico): ?>
                <?php if ($medico['id_rol'] == 4): ?> <!-- Solo medicos -->
                    <option value="<?= $medico['id_Usuario'] ?>" data-id-rol="<?= $medico['id_rol'] ?>"><?= $medico['nombre']; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select><br>
        <label for="fecha_turno">Seleccione la fecha de su turno.</label>
        <br><input type="datetime-local" id="fecha_turno" name="fecha_turno"></br>
        <label for="id_Metpago">Metodo de pago:</label><br>
        <select class="form-select" name="id_Metpago" id="id_Metpago" required>
            <option value="">Seleccione uno</option>
            <?php foreach ($metpagos as $metpago): ?>
                <option value="<?= $metpago['id_Metpago'] ?>"><?= $metpago['metodo']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <a href="turnosDisponibles">Ver Turnos disponibles</a>
        <input type="submit" value="Añadir Turno">
    </form>
</body>
</html>