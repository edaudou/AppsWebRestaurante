<div>
	<a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>reservas/add">Crear Reserva</a>
	<?php foreach($viewmodel as $item) : ?>
		<div class="well">
			<!-- Fecha de la reserva -->
			<h3>Fecha: <?php echo $item['reservation_date']; ?></h3>

			<!-- Hora de la reserva -->
			<small>Hora: <?php echo $item['reservation_time']; ?></small>

			<hr />

			<!-- Número de personas -->
			<p><strong>Número de Personas:</strong> <?php echo $item['num_people']; ?></p>

			<br />

			<!-- Botones para editar o eliminar la reserva (si se necesita) -->
			<a class="btn btn-primary" href="<?php echo ROOT_PATH; ?>reservas/edit/<?php echo $item['id']; ?>">Editar</a>
			<a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>reservas/delete/<?php echo $item['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">Eliminar</a>
			
		</div>
	<?php endforeach; ?>
</div>
