<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('css/formMedico.css')?>">
</head>

<body>
    <div class="container">
        <!-- Formulario de registro -->
        <div class="register-form">
            <h2>Administrador</h2>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <form method="post" action="<?= base_url('nuevoMed') ?>">

                <label for="nombre">Nombre de usuario</label>
                <input type="text" id="username" name="nombre" required><br>

                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" required><br>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" min="8" max="25" required><br>

                <label for="especialidad">Especialidad</label>
                <select id="especialidad" name="especialidad" required>
                    <option value="">Seleccione una especialidad</option>
                    <?php foreach ($especialidades as $especialidad): ?>
                        <option value="<?= $especialidad['id_Especialidad'] ?>"><?= $especialidad['tipo'] ?></option>
                    <?php endforeach; ?>
                </select><br>
                <div id="horarios-container">
                    <div class="horario">
                        <label for="dia_sem">Día de la semana:</label>
                        <input type="text" name="horarios[0][dia_sem]" required><br>

                        <label for="hora_inicio">Hora de inicio:</label>
                        <input type="time" name="horarios[0][hora_inicio]" required><br>

                        <label for="hora_final">Hora de fin:</label>
                        <input type="time" name="horarios[0][hora_final]" required><br>
                    </div>
                </div>

                <button type="submit" href="<?= base_url('nuevoMed') ?>">Registrar nuevo medico</button>
            </form><br>
        </div>
    
</body>

</html>