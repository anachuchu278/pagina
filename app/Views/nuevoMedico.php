<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?= base_url('css/editPaciente.css')?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <title>Nuevo Medico</title>
</head>
<body>
    <form method="post" action="<?= base_url('newMed')?>">
        <label for="id_Usuario">Usuario:</label><br>
        <select name="id_Usuario" id="id_Usuario" <?= isset($paciente['id_Paciente']) ? 'disabled' : 'required' ?> onchange="checkUserRole()">
            <option value="">Seleccione un usuario</option>
            <?php foreach ($usuarios as $usuario): ?>
                <?php if ($usuario['id_rol'] == 4): ?> <!-- Excluir usuarios con rol de administrador -->
                    <option value="<?= $usuario['id_Usuario'] ?>" data-id-rol="<?= $usuario['id_rol'] ?>" <?= (isset($paciente['id_Usuario']) && $paciente['id_Usuario'] == $usuario['id_Usuario']) ? 'selected' : '' ?>><?= $usuario['nombre'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select><br>

        <label for="especialidad">Seleccionar especialidad:</label>
        <select name="especialidad" id="especialidad">
            <option value="">Seleccionar especialidad:</option>
            <?php foreach ($especialidades as $especialidad): ?>
                <option value="<?= esc($especialidad['id_Especialidad']) ?>"><?= esc($especialidad['tipo']) ?></option>
            <?php endforeach; ?>
        </select><br>
        <input type="submit" value="Añadir" id="">
    </form>
</body>
</html>