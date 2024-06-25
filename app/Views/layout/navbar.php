<head>
    <link rel="stylesheet" href="<?= base_url('css/navbar.css');?>">
</head>
<nav class="navbar">
    <div class="navbar-logo">
        <img src="img/logo.png" alt="Logo">
    </div>
    <ul class="navbar-menu">
        <li><a href="/">Inicio</a></li>
        <li><a href="turnos">Turnos</a></li>
        <li><a href="newPacienteView">Mis Datos</a></li>
        <form class="advanced-search">
            <input type="text" placeholder="Buscar...">
            <button type="submit">Buscar</button>
        </form>
        <li><a href="Logout">Logout</a></li>
    </ul>
</nav>
