<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo base_url('calendario.css') ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Turnos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="left">
            <div class="calendar">
                <div class="month">
                    <i class="fa fa-angle-left prev"></i>
                    <div class="date">Junio 2024</div>
                    <i class="fa fa-angle-right next"></i>
                </div> 
                <div class="week">
                    <div>Lu</div>
                    <div>Ma</div>
                    <div>Mi</div>
                    <div>Ju</div>
                    <div>Vi</div>
                    <div>Sa</div>
                    <div>Do</div>
                </div> 
                <div class="days">
                    <div class="day">1</div>
                    <div class="day">2</div>
                    <div class="day">3</div>
                    <div class="day">4</div>
                    <div class="day">5</div>
                    <div class="day">6</div>
                    <div class="day">7</div>
                    <div class="day">8</div>
                    <div class="day">9</div>
                    <div class="day">10</div>
                    <div class="day">11</div>
                    <div class="day">12</div>
                    <div class="day">13</div>
                    <div class="day">14</div>
                    <div class="day">15</div>
                    <div class="day">16</div>
                    <div class="day">17</div>
                    <div class="day">18</div>
                    <div class="day">19</div>
                    <div class="day">20</div>
                    <div class="day">21</div>
                    <div class="day">22</div>
                    <div class="day">23</div>
                    <div class="day">24</div>
                    <div class="day active">25</div>
                    <div class="day">26</div>
                    <div class="day">27</div>
                    <div class="day">28</div>
                    <div class="day">29</div>
                    <div class="day">30</div>
                    
                </div>
                <div class="goto-today">
                    <div class="goto">
                        <input type="text" placeholder="mm/yyyy" class="date-input">
                        <button class="goto-btn">ir</button>
                    </div>
                    <button class="goto-today">Dia Actual</button>
                </div>
            </div>
        </div> 
    </div>



<script src="<?php echo base_url('script.js')?>"></script>
</body>

</html>