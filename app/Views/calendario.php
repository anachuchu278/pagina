<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendario</title>
    <link rel="stylesheet" href="<?php echo base_url('css/calendario.css')?>">
</head>
<body class="light">
    <div class="calendar">
        <div class="calendar-header">
            <span class="month-picker" id="month-picker">
                Agosto
            </span>
            <div class="year-picker">
                <span class="year-change" id="prev-year">
                    <pre><</pre>
                </span>
                <span id="year">2024</span>
                <span class="year-change" id="next-year">
                    <pre>></pre>
                </span>
            </div>
        </div>
        <div class="calendar-body">
            <div class="calendar-week-days">
                <span class="week-day">Lun</span>
                <span class="week-day">Mar</span>
                <span class="week-day">Mie</span>
                <span class="week-day">Jue</span>
                <span class="week-day">Vie</span>
                <span class="week-day">Sab</span>
                <span class="week-day">Dom</span>
            </div>
            <div class="calendar-days">
                <div>1</div>
                <div>2</div>
                <div>3</div>
                <div>4</div>
                <div>5</div>
                <div>6</div>
                <div>7</div>

            </div>

        </div>
    </div>
 
</body>
</html>