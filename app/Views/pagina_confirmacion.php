
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?= base_url('css/confirmacion.css') ?>">
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Código</title>
</head>
<body>

    <!-- Mostrar errores si hay -->
    <?php if (session()->getFlashdata('error')): ?>
        <p style="color:red;"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>
    
    <!-- Envolvemos el h1 y el formulario en un div contenedor -->
    <div class="form-container">
        <?php if (!session()->getFlashData('codigoValido')): ?>
            <h1>Ingresar Código</h1>
            <form action="<?= base_url('validar-codigo') ?>" method="post">
                <label for="codigo">Código:</label>
                <input type="text" name="codigo_turno" id="codigo" required>
                <button type="submit">Validar</button>
            </form>
        <?php endif; ?>
    </div>

    <!-- Mostrar los pasos a seguir si el código es válido -->
    <?php if (session()->getFlashdata('codigoValido')): ?>
        <div id="pasos-a-seguir" style="margin-top: 20px;">
            <h2>Pasos a seguir</h2>
            <ol>
                <li>Espere a ser llamado por recepcion.</li>
                <li>Cuando escuche su nombre dirijase al box correspondiente.</li>
                <li>Si lo desea puede volver a la pagina principal.<a href="<?= base_url('pagina') ?>">Volver</a></li>
            </ol>
        </div>
    <?php endif; ?>

</body>
</html>
