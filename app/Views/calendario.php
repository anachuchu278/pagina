<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario Dinámico</title>
    <link rel="stylesheet" href="<?= base_url('css/calendario.css')?>">
</head>
<body>
    <div class="calendar-container">
        <div class="calendar-header">
            <button id="prev-month">&lt;</button>
            <h2 id="month-year"></h2>
            <button id="next-month">&gt;</button>
        </div>
        <div class="calendar-body">
            <div class="calendar-weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>
            <div class="calendar-days" id="calendar-days"></div>
        </div>
    </div> 
    <h3>Turnos del Usuario</h3>
    <table border="1">
        <thead>
            <tr>
                <th>ID Turno</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($turno)) : ?>
                <?php foreach ($turno as $tur) : ?>
                    <tr>
                        <td><?=  $tur['fecha_hora'] ?></td>
                        <td><?=  $tur['codigo_turno'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">No hay turnos disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <script src="<?= base_url('script.js')?>"></script> 
</body>
</html>