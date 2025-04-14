<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Editar Mesa</h3>
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
          value="<?php echo $viewmodel['table_number']; ?>" 
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
          value="<?php echo $viewmodel['capacity']; ?>" 
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
          value="<?php echo $viewmodel['location']; ?>" 
          required 
        />
      </div>

      <!-- Estado -->
      <div class="form-group">
        <label for="status">Estado</label>
        <select name="status" id="status" class="form-control" required>
          <option value="Disponible" <?php if ($viewmodel['status'] === 'Disponible') echo 'selected'; ?>>Disponible</option>
          <option value="Ocupada" <?php if ($viewmodel['status'] === 'Ocupada') echo 'selected'; ?>>Ocupada</option>
          <option value="Reservada" <?php if ($viewmodel['status'] === 'Reservada') echo 'selected'; ?>>Reservada</option>
        </select>
      </div>

      <!-- Botones -->
      <input 
        class="btn btn-primary" 
        name="submit" 
        type="submit" 
        value="Actualizar" 
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
