<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Agregar Mesa</h3>
  </div>

  <div class="panel-body">
    <form method="post" action="">

      <!-- Número de Mesa -->
      <div class="form-group">
        <label for="table_number">Número de Mesa</label>
        <input 
          type="number" 
          name="table_number" 
          id="table_number" 
          class="form-control" 
          min="1" 
          required 
        />
      </div>

      <!-- Capacidad -->
      <div class="form-group">
        <label for="capacity">Capacidad</label>
        <input 
          type="number" 
          name="capacity" 
          id="capacity" 
          class="form-control" 
          min="1" 
          required 
        />
      </div>

      <!-- Ubicación -->
      <div class="form-group">
        <label for="location">Ubicación</label>
        <input 
          type="text" 
          name="location" 
          id="location" 
          class="form-control" 
          required 
        />
      </div>

      <!-- Estado -->
      <div class="form-group">
        <label for="status">Estado</label>
        <select name="status" id="status" class="form-control" required>
          <option value="Disponible">Disponible</option>
          <option value="Ocupada">Ocupada</option>
          <option value="Reservada">Reservada</option>
        </select>
      </div>

      <!-- Botones -->
      <input 
        class="btn btn-primary" 
        name="submit" 
        type="submit" 
        value="Guardar" 
      />
      <a 
        class="btn btn-danger" 
        href="<?php echo ROOT_PATH; ?>tables"
      >
        Cancelar
      </a>
    </form>
  </div>
</div>
