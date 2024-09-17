
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?= base_url('css/confirmacion.css') ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Código</title>
</head>
<body>
    
    <!-- Mostrar errores si hay -->
    <?php if (session()->getFlashdata('error')): ?>
        <p style="color:red;"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>
<?php if (!session()->getFlashData('codigoValido')): ?>
    <h1>Ingresar Código</h1>
    
    <form action="<?= base_url('validar-codigo') ?>" method="post">
        <label for="codigo">Código:</label>
        <input type="text" name="codigo_turno" id="codigo" required>
        <button type="submit">Validar</button>
    </form> 
<?php endif; ?>
    <?php if (session()->getFlashdata('codigoValido')): ?>
        <div id="pasos-a-seguir" style="margin-top: 20px;">
            <h2>Pasos a seguir:</h2>
            <ol>
                <li>Confirmar tu turno.</li>
                <li>Realizar el pago correspondiente.</li>
                <li>Esperar la confirmación por correo electrónico.</li>
            </ol>
        </div>
    <?php endif; ?>
</body>
</html>