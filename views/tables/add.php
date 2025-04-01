<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Crear una Reserva</h3>
  </div>
  <div class="panel-body">
  <form method="POST" action="">
    <div class="form-group">
        <label>Usuario:</label>
        <select name="user_id" class="form-control">
            <?php foreach ($viewmodel['users'] as $user) : ?>
                <option value="<?php echo $user['id']; ?>">
                    <?php echo $user['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Mesa:</label>
        <select name="table_id" class="form-control">
            <?php foreach ($viewmodel['tables'] as $table) : ?>
                <option value="<?php echo $table['id']; ?>">
                    Mesa <?php echo $table['table_number']; ?> - Capacidad: <?php echo $table['capacity']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Fecha de reserva:</label>
        <input type="date" name="reservation_date" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Hora de reserva:</label>
        <input type="time" name="reservation_time" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Número de personas:</label>
        <input type="number" name="num_people" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Petición especial:</label>
        <textarea name="special_request" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Reserva</button>
</form>

  </div>
</div>
