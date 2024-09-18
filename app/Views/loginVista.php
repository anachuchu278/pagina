<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= base_url('css/login.css')?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<div class="login-form">
        <h2>Iniciar sesión</h2>
        <?php if (session()->getFlashdata('error')): ?>
			<div class="alert alert-danger">
				<?= session()->getFlashdata('error') ?>
			</div>
		<?php endif; ?>
        <form action="<?= base_url('login1') ?>" method="POST">
			<label for="email">Email</label>
			<input type="email" id="email" name="email" required>
			<label for="password">Password</label>
			<div class="container">
			<input type="password" id="pass" name="password" class="pass" required>
			<i class="bx bx-show-alt"></i>
			</div>
			<button type="submit">Login</button>
		</form>	
		<a href="<?= base_url('/')?>">No tienes cuenta? Registrate</a>
		</div>
		
		<script src="<?php echo base_url('mostrar.js')?>" ></script>
</body>
</html> 

