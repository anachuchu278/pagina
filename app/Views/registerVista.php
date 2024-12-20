<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?= base_url('css/register.css') ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <title>Register</title>
</head>
<body>
<div class="register-form">
        <h2>Registro</h2>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?= base_url('register')?>" > 
            
            <label for="nombre">Nombre de usuario</label>
            <input type="text" id="username" name="nombre"  required><br>
            
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email"  required><br>
            
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" min="8" max="25" required><br>
            
            <button type="submit" href="<?= base_url('register') ?>">Registrarse</button>
        </form><br>
        <a href="loginVista" >Loguearse</a>
    </div>
</body>
</html> 

