<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="<?php echo base_url('css/perfil.css')?>">
    <title>Perfil</title>
</head>
<body> 
    <?php if (isset($user)): ?>
    <h2>Bienvenido,
        <?php echo $user['nombre']; ?>
    </h2> 

    <h3>Datos del Usuario</h3>  
        <div class="info-perfil"> 
            <label for="nombre">Nombre</label>
            <p><?php echo $user['nombre'];?></p>
            <label for="email">Email</label>
            <p><?php echo $user['email'];?></p>
            <label for="ID">ID</label>
            <p><?php echo $user['id_Usuario'];?></p>
            <label for="id_rol">Id del Rol</label>
            <p><?php echo $user['id_rol'];?></p>
        

        </div>
    <?php else: ?> 
    
    <?php endif; ?>
</body>
</html>