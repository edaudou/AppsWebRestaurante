<div class="text-center">
	<h1>Bienvenido al restaurante</h1>
	<p class="lead">Reserva Ya Aqui</p>
	<a class="btn btn-primary text-center" href="<?php echo ROOT_PATH;?>reservas">Reserva Ya!</a>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    <?php
                    foreach ($fechas_ocupadas as $fecha) {
                        echo "{ title: 'Ocupado', start: '$fecha', color: 'red' },";
                    }
                    ?>
                ]
            });
            calendar.render();
        });
    </script>
</div>