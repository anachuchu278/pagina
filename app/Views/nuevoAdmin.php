<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo base_url('css/nuevoAdmin.css') ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar un Administrador</title>
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
        <form method="post" action="<?= base_url('nuevoadmin') ?>">

            <label for="nombre">Nombre de usuario</label>
            <input type="text" id="username" name="nombre" required><br>

            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" min="8" max="25" required><br>

            <button type="submit" href="<?= base_url('nuevoadmin') ?>">Registrar nuevo admin</button>
        </form><br>
    </div>

    <!-- Tabla de administradores -->
    <div class="admin-table">
        <h2>Lista de Administradores</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($admin)): ?>
                    <?php foreach ($admin as $a): ?>
                        <tr>
                            <td><?= $a['id_Usuario']; ?></td>
                            <td><?= $a['nombre']; ?></td>
                            <td><?= $a['email']; ?></td>
                            <td>Administrador</td>
                            <td>
                                <form action="<?= site_url('admin/eliminar') ?>" method="post">
                                <input type="hidden" name="id_Usuario" value="<?= $a['id_Usuario']?>">
                                <button type="submit" class="btn-delete">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No hay administradores.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="volver-container">
    <a href="pagina" class="volver">Volver</a>
</div>
</body>

</html>