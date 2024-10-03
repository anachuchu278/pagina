<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('css/paginaMain.css') ?>">
</head>

<body>

    <div class="box">
        <nav>
            <ul class="menu-horizontal">
                <li>
                    <a href="">Gestion</a>
                    <ul class="menu-vertical">
                        <li><a href="">Turnos</a></li>
                        <li><a href="">Generar un turno</a></li>
                        <li><a href="">Añadir un Paciente</a></li>
                    </ul>
                </li>
                <li><a href="">Perfil</a></li>
                <li><a href="">Calendario</a></li>
                <li><a href="<?= base_url('logout') ?>">Cerrar Sesion</a></li>
                <?php if ($showAdmin): ?>
                    <li><a class="" href="<?= site_url('vistaAdmin') ?>">Admin</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <section class="inicio">
            <div class="text">
                <h2>bienvenido</h2>
            </div>
        </section>

        <div id="smooth-scroll"></div>

        <section class="contenido">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam necessitatibus natus exercitationem maiores voluptate quos sequi earum suscipit hic fugit, quasi cupiditate. Sunt minus, alias non voluptas hic harum suscipit?</p>
        </section>

        <section class="otra-seccion" id="pene">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, commodi voluptatum consectetur necessitatibus iste sed obcaecati minima fugiat molestiae modi ipsa debitis. At, impedit explicabo esse enim necessitatibus quis natus!</p>
        </section>
    </div>

    <!-- Incluye smooth-scrollbar y la inicialización aquí -->
    
</body>

</html>
