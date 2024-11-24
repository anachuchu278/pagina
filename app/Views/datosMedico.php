<!DOCTYPE html>
    <html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Perfil del Médico</title>
    <link rel="stylesheet" href="<?= base_url('css/datosMedico.css') ?>">
</head>
<body>
    <div class="container">
        <h2>Perfil del Médico</h2>
        <div class="medico-info">
            <img src="<?= base_url($medico['imagen_ruta']) ?>" alt="Imagen del médico" style="width: 100px; height: 100px;">
            <p><strong>Nombre:</strong> <?= htmlspecialchars($medico['nombre']) ?></p>
            <p><strong>Correo electrónico:</strong> <?= htmlspecialchars($medico['email']) ?></p>
            <p><strong>Especialidad:</strong> <?= htmlspecialchars($especialidad['tipo']) ?></p>
        </div>
        <a href="<?= base_url('turnosMedico') ?>">Ver tus turnos</a>
        <a href="<?= base_url('pagina') ?>">Volver a Inicio</a>
        <div class="medico-info">
        <?php if (!empty($horarios)) :?>
            <table class="table table-striped" style="margin-top: 10px;">
                <thead>
                    <tr>
                        <th>Días</th>
                        <th>Hora de Inicio</th>
                        <th>Hora Final</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($horarios as $horario) :?>
                    <tr>
                        <th><?= $horario['dia_sem']?></th>
                        <th><?= $horario['hora_inicio']?></th>
                        <th><?= $horario['hora_final']?></th>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        <?php endif;?>
        </div>
    </div>
</body>
</html>