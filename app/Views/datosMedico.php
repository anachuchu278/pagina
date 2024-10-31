<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Médico</title>
    <link rel="stylesheet" href="<?= base_url('css/formMedico') ?>">
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

        <a href="<?= base_url('crudMeds') ?>">Volver a la lista de médicos</a>
    </div>
</body>

</html>