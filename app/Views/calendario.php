<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calendario</title>
    <link rel="stylesheet" href="<?php echo base_url('css/calendario.css')?>">
</head>
<body>
    <div class="root">
        <div class="calendar" id="calendar">
            <div clas="calendar_header">
                <button class="control control--prev">&lt;
                </button>
                <span class="month-name">Agosto 2024</span>
                <button class="control control--next">&gt;</button>
            </div>
        </div>
        <div class="calendar_body" id="calendar2">
            <div class="grid">
                <div class="grid_header">
                    <div class="grid__body">
                        <span class="grid__cell grid_cell--gh">Lun</span>
                        <span class="grid__cell grid_cell--gh">Mar</span>
                        <span class="grid__cell grid_cell--gh">Mie</span>
                        <span class="grid__cell grid_cell--gh">Jue</span>
                        <span class="grid__cell grid_cell--gh">Vie</span>
                        <span class="grid__cell grid_cell--gh">Sab</span>
                        <span class="grid__cell grid_cell--gh">Dom</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/es.js"></script>
    <script  type="text/javascript" src="<?php base_url('script.js')?>"></script>
    <script type="text/javascript">
        let calendar = new Calendar('calendar');
        calendar.getElement().addEventListener('change', e => {
            console.log(calendar.value().format('LLL'));
        });

        let calendar2 = new Calendar('calendar2');
        calendar2.getElement().addEventListener('change', e => {
            console.log(calendar2.value().format('LLL'));
        });
    </script>
</body>
</html>