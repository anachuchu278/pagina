<!DOCTYPE html>
<html lang="en">
<head> 
    <link rel="stylesheet" href="<?= base_url('css/editPaciente.css')?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <title><?= isset($paciente['id_Paciente']) ? "Editar " . $paciente['nombre'] : "Añadir Paciente" ?></title>
</head>
<body>
    <form action="<?= isset($paciente['id_Paciente']) ? base_url('editarPaciente/' . $paciente['id_Paciente']) : base_url('newPaciente') ?>" method="POST">
        <?php if (isset($paciente['id_Paciente'])): ?>
            <input type="hidden" name="id_Paciente" value="<?= $paciente['id_Paciente'] ?>">
        <?php endif; ?>

        <label for="id_Usuario">Usuario:</label><br>
        <select name="id_Usuario" id="id_Usuario" <?= isset($paciente['id_Paciente']) ? 'disabled' : 'required' ?> onchange="checkUserRole()">
            <option value="">Seleccione un usuario</option>
            <?php foreach ($usuarios as $usuario): ?>
                <?php if ($usuario['id_rol'] != 2): ?> <!-- Excluir usuarios con rol de administrador -->
                    <option value="<?= $usuario['id_Usuario'] ?>" data-id-rol="<?= $usuario['id_rol'] ?>" <?= (isset($paciente['id_Usuario']) && $paciente['id_Usuario'] == $usuario['id_Usuario']) ? 'selected' : '' ?>><?= $usuario['nombre'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select><br>

        <div id="especialidad-container" style="display: none;">
            <label for="especialidad">Seleccionar especialidad:</label>
            <select name="especialidad" id="especialidad">
                <?php foreach ($especialidades as $especialidad): ?>
                    <option value="<?= esc($especialidad['id_Especialidad']) ?>"><?= esc($especialidad['tipo']) ?></option>
                <?php endforeach; ?>
            </select><br>
        </div>

        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?= isset($paciente['nombre']) ? $paciente['nombre'] : '' ?>" required><br>

        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" value="<?= isset($paciente['apellido']) ? $paciente['apellido'] : '' ?>" required><br>

        <label for="dni">DNI:</label><br>
        <input type="number" id="dni" name="dni" value="<?= isset($paciente['dni']) ? $paciente['dni'] : '' ?>" min="1000000" max="99999999"><br>

        <label for="edad">Edad:</label><br>
        <input type="number" id="edad" name="edad" value="<?= isset($paciente['edad']) ? $paciente['edad'] : '' ?>" max="100"><br>

        <label for="altura_cm">Altura (cm):</label><br>
        <input type="number" id="altura_cm" name="altura_cm" value="<?= isset($paciente['altura_cm']) ? $paciente['altura_cm'] : '' ?>" max="250"><br>

        <label for="peso">Peso(kg):</label><br>
        <input type="number" id="peso" name="peso" value="<?= isset($paciente['peso']) ? $paciente['peso'] : '' ?>" max="200"><br>

        <label for="historia_clinica">Historia clínica:</label><br>
        <input type="text" id="historia_clinica" name="historia_clinica" value="<?= isset($paciente['historia_clinica']) ? $paciente['historia_clinica'] : '' ?>" max="99999999999"><br>

        <label for="id_Obra">Obra:</label><br>
        <select name="id_Obra" id="id_Obra" required>
            <?php foreach ($obras as $obra): ?>
                <option value="<?= $obra['id_Obra'] ?>" <?= (isset($paciente['id_Obra']) && $paciente['id_Obra'] == $obra['id_Obra']) ? 'selected' : '' ?>><?= $obra['nombre'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="id_Sangre">Tipo de sangre:</label><br>
        <select name="id_Sangre" id="id_Sangre" required>
            <?php foreach ($tiposans as $tiposan): ?>
                <option value="<?= $tiposan['id_Sangre'] ?>" <?= (isset($paciente['id_Sangre']) && $paciente['id_Sangre'] == $tiposan['id_Sangre']) ? 'selected' : '' ?>><?= $tiposan['tipo'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="rh_tipo">RH positivo:</label>
        <input type="checkbox" id="rh_tipo" name="rh" value="1" <?= (isset($paciente['RH_tipo_sangre']) && $paciente['RH_tipo_sangre'] == '1') ? 'checked' : '' ?>><br>

        <input type="submit" value="<?= isset($paciente['id_Paciente']) ? 'Guardar Cambios' : 'Añadir' ?>">
    </form>
</body>
<script>
    function checkUserRole() {
        var select = document.getElementById('id_Usuario');
        var selectedOption = select.options[select.selectedIndex];
        var idRol = selectedOption.getAttribute('data-id-rol');
        var especialidadContainer = document.getElementById('especialidad-container');

        if (idRol == '4') {
            especialidadContainer.style.display = 'block';
        } else {
            especialidadContainer.style.display = 'none';
        }
    }

    // Llamar a la función al cargar la página para verificar el rol del usuario seleccionado
    window.onload = checkUserRole;
</script>
</html>
