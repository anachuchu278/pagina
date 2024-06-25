<!DOCTYPE html>
<html lang="en">
<head>
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
			<label for="email">Email:</label>
			<input type="email" id="email" name="email" required>
			
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>

			<button type="submit">Login</button>
		</form>	
    </div>
</body>
</html>
