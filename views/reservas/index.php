<div>
	<a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>reservas/add">Crear Reserva</a>
	<!-- Barra de búsqueda -->
	<form method="GET" action="<?php echo ROOT_PATH; ?>reservas">
        <input type="text" name="search" placeholder="Buscar reserva..." class="form-control" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" />
		<button type="submit" class="btn btn-primary">Buscar</button>
	</form>
	<?php foreach ($viewmodel as $item) : ?>
        <div class="well">
            <h3>Fecha: <?php echo $item['reservation_date']; ?></h3>
            <small>Hora: <?php echo $item['reservation_time']; ?></small>
            <hr />
            <p><strong>Número de Personas:</strong> <?php echo $item['num_people']; ?></p>
            <br />
            <a class="btn btn-primary" href="<?php echo ROOT_PATH; ?>reservas/edit/<?php echo $item['id']; ?>">Editar</a>
            <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>reservas/delete/<?php echo $item['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">Eliminar</a>
        </div>
    <?php endforeach; ?>
    <div>
    <input type="text" id="searchReserva" placeholder="Buscar reserva..." class="form-control" />

    <div id="reservaResults">
        <!-- Aquí se mostrarán los resultados de la búsqueda -->
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
                        <small>Hora: ${reserva.reservation_time} | Personas: ${reserva.num_people}</small>
                        <hr />
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