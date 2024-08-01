<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?php echo base_url('css/nuevoAdmin.css')?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar un Administrador</title>
</head>
<body>
<div class="register-form">
        <h2>Administrador</h2>
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
        <form method="post" action="<?= base_url('nuevoadmin')?>" > 
            
            <label for="nombre">Nombre de usuario</label>
            <input type="text" id="username" name="nombre"  required><br>
            
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email"  required><br>
            
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" min="8" max="25" required><br>
            
            <button type="submit" href="<?= base_url('nuevoadmin') ?>">Registrar nuevo admin</button>
        </form><br>
    </div>
</body>
</html>