<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Editar Reserva</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="">
      <!-- Fecha de la reserva -->
      <div class="form-group">
        <label for="reservation_date">Fecha</label>
        <input 
          type="date" 
          name="reservation_date" 
          id="reservation_date" 
          class="form-control" 
          value="<?php echo $viewmodel['reservation_date']; ?>" 
          required 
        />
      </div>

      <!-- Hora de la reserva -->
      <div class="form-group">
        <label for="reservation_time">Hora</label>
        <input 
          type="time" 
          name="reservation_time" 
          id="reservation_time" 
          class="form-control" 
          value="<?php echo $viewmodel['reservation_time']; ?>" 
          required 
        />
      </div>

      <!-- Número de personas -->
      <div class="form-group">
        <label for="num_people">Número de personas</label>
        <input 
          type="number" 
          name="num_people" 
          id="num_people" 
          class="form-control" 
          min="1" 
          max="20" 
          value="<?php echo $viewmodel['num_people']; ?>" 
          required 
        />
      </div>

      <!-- Botones de acción -->
      <input 
        class="btn btn-primary" 
        name="submit" 
        type="submit" 
        value="Guardar Cambios" 
      />
      <a 
        class="btn btn-danger" 
        href="<?php echo ROOT_PATH; ?>reservas"
      >
        Cancelar
      </a>
    </form>
  </div>
</div>
