<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?php echo base_url('css/turno.css')?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Turno</title>
</head>
<body>
    <a href="<?php echo base_url('pagina') ?>" class="boton-volver">Volver</a>
    <form action="newTurno1" method="POST">
        <label for="id_Medico">Medico:</label><br>
        <select class="form-select" name="id_Medico" id="id_Medico" required>
            <option value="">Seleccione un medico</option>
            <?php foreach ($medicos as $medico): ?>
                <?php if ($medico['id_rol'] == 4): ?> <!-- Solo medicos -->
                    <option value="<?= $medico['id_Usuario'] ?>" data-id-rol="<?= $medico['id_rol'] ?>" ><?= $medico['nombre']; ?> - <?= $medico['id_especialidad']; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select><br>
        <label for="id_Horario">Hora:</label><br>
            <select class="form-select" name="id_Horario" id="id_Horario" required>
                <?php foreach ($horarios as $horario): ?>
                    <option value="<?= $horario['id_Horario'] ?>"><?= $horario['dia_sem']; ?> - <?= $horario['hora_inicio']; ?> - <?= $horario['hora_final']; ?></option>
                <?php endforeach; ?>
            </select><br>
        <input type="submit" value="Añadir Turno">
    </form>
</body>
</html>