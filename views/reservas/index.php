<div>
    <a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>reservas/add">Crear Reserva</a>

    <!-- Barra de búsqueda con AJAX -->
    <input type="text" id="searchReserva" placeholder="Buscar reserva..." class="form-control" />

    <!-- Resultados de búsqueda -->
    <div id="reservaResults">
        <?php foreach ($viewmodel as $item) : ?>
            <div class="well">
                <h3>Fecha: <?php echo $item['reservation_date']; ?></h3>
                <small>Hora: <?php echo $item['reservation_time']; ?></small>
                <p><strong>Número de Personas:</strong> <?php echo $item['num_people']; ?></p>
                <p><strong>Mesa:</strong> <?php echo $item['table_number']; ?></p>
                <p><strong>Usuario:</strong> <?php echo $item['user_name']; ?></p>
                <a class="btn btn-primary" href="<?php echo ROOT_PATH; ?>reservas/edit/<?php echo $item['id']; ?>">Editar</a>
                <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>reservas/delete/<?php echo $item['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta reserva?');">Eliminar</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
document.getElementById('searchReserva').addEventListener('keyup', function() {
    let searchQuery = this.value;
    let xhr = new XMLHttpRequest();
    
    xhr.open('POST', '<?php echo ROOT_URL; ?>reservas/searchReservations', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if (this.status === 200) {
            let reservas = JSON.parse(this.responseText);
            let output = '';

            if (reservas.length > 0) {
                reservas.forEach(reserva => {
                    output += `<div class="well">
                        <h3>Fecha: ${reserva.reservation_date}</h3>
                        <small>Hora: ${reserva.reservation_time}</small>
                        <p><strong>Número de Personas:</strong> ${reserva.num_people}</p>
                        <p><strong>Mesa:</strong> ${reserva.table_number}</p>
                        <p><strong>Usuario:</strong> ${reserva.user_name}</p>
                        <a class="btn btn-primary" href="<?php echo ROOT_PATH; ?>reservas/edit?id=${reserva.id}">Editar</a>
                        <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>reservas/delete?id=${reserva.id}" onclick="return confirm('¿Estás seguro de eliminar esta reserva?');">Eliminar</a>
                    </div>`;
                });
            } else {
                output = '<p>No se encontraron reservas.</p>';
            }

            document.getElementById('reservaResults').innerHTML = output;
        }
    };

    xhr.send('search=' + searchQuery);
});
</script>
</div>