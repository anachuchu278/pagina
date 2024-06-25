<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($paciente['id_Paciente']) ? "Editar " . $paciente['nombre'] : "Añadir Paciente" ?></title>
</head>
<body>
    <form action="<?= isset($paciente['id_Paciente']) ? base_url('guardarPaciente/' . $paciente['id_Paciente']) : base_url('guardarPaciente') ?>" method="POST">
        <?php if (isset($paciente['id_Paciente'])): ?>
            <input type="hidden" name="id_Paciente" value="<?= $paciente['id_Paciente'] ?>">
        <?php endif; ?>

        <label for="id_Usuario">Usuario:</label><br>
        <select name="id_Usuario" id="id_Usuario" <?= isset($paciente['id_Paciente']) ? 'disabled' : 'required' ?>>
            <?php foreach ($usuarios as $usuario): ?>
                <?php if ($usuario['id_rol'] != 2): ?> <!-- Excluir usuarios con rol de administrador -->
                    <option value="<?= $usuario['id_Usuario'] ?>" <?= (isset($paciente['id_Usuario']) && $paciente['id_Usuario'] == $usuario['id_Usuario']) ? 'selected' : '' ?>><?= $usuario['nombre'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select><br>

        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?= isset($paciente['nombre']) ? $paciente['nombre'] : '' ?>" required><br>

        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" value="<?= isset($paciente['apellido']) ? $paciente['apellido'] : '' ?>" required><br>

        <label for="dni">DNI:</label><br>
        <input type="number" id="dni" name="dni" value="<?= isset($paciente['dni']) ? $paciente['dni'] : '' ?>"><br>

        <label for="edad">Edad:</label><br>
        <input type="number" id="edad" name="edad" value="<?= isset($paciente['edad']) ? $paciente['edad'] : '' ?>"><br>

        <label for="altura_cm">Altura (cm):</label><br>
        <input type="number" id="altura_cm" name="altura_cm" value="<?= isset($paciente['altura_cm']) ? $paciente['altura_cm'] : '' ?>"><br>

        <label for="peso">Peso:</label><br>
        <input type="number" id="peso" name="peso" value="<?= isset($paciente['peso']) ? $paciente['peso'] : '' ?>"><br>

        <label for="historia_clinica">Historia clínica:</label><br>
        <input type="text" id="historia_clinica" name="historia_clinica" value="<?= isset($paciente['historia_clinica']) ? $paciente['historia_clinica'] : '' ?>"><br>

        <label for="id_obra">Obra:</label><br>
        <select name="id_obra" id="id_obra" required>
            <?php foreach ($obras as $obra): ?>
                <option value="<?= $obra['id'] ?>" <?= (isset($paciente['id_obra']) && $paciente['id_obra'] == $obra['id']) ? 'selected' : '' ?>><?= $obra['nombre'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="id_tipo_sangre">Tipo de sangre:</label><br>
        <select name="id_tipo_sangre" id="id_tipo_sangre" required>
            <?php foreach ($tiposans as $tiposan): ?>
                <option value="<?= $tiposan['id_sangre'] ?>" <?= (isset($paciente['id_tipo_sangre']) && $paciente['id_tipo_sangre'] == $tiposan['id_sangre']) ? 'selected' : '' ?>><?= $tiposan['tipo'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="rh_tipo">RH positivo:</label>
        <input type="checkbox" id="rh_tipo" name="rh" value="1" <?= (isset($paciente['RH_tipo_sangre']) && $paciente['RH_tipo_sangre'] == '1') ? 'checked' : '' ?>><br>

        <input type="submit" value="<?= isset($paciente['id_Paciente']) ? 'Guardar Cambios' : 'Añadir' ?>">
    </form>
</body>
</html>
