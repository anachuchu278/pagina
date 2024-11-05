<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="<?php echo base_url('css/perfil.css')?>">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
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
            <label for="id_rol">Rol</label>
            <p><?php echo $user['nombre_rol'];?></p> 
            <label class="imagen" for="imagen">Imagen Del Usuario</label>
            <img src="<?=  base_url($user['imagen_ruta']);?>" alt="">
        </div>
    <?php else: ?> 
    
    <?php endif; ?> 
    <div class="volver-container">
    <a href="pagina" class="volver">Volver</a>
    </div>
</body>
</html>