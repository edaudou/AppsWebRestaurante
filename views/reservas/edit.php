<div class="container mt-4">
  <div class="card shadow-lg">
    <div class="card-header bg-primary text-white">
      <h3 class="card-title mb-0">Editar Reserva</h3>
    </div>
    <div class="card-body">
      <form method="post" action="">
        
        <!-- Usuario -->
        <div class="mb-3">
          <label for="user_id" class="form-label">Usuario</label>
          <select name="user_id" id="user_id" class="form-select form-select-lg" required>
            <option value="">Seleccione un usuario</option>
            <?php foreach ($viewmodel['users'] as $user) : ?>
              <option value="<?php echo $user['id']; ?>" 
                <?php echo ($user['id'] == $viewmodel['reservation']['user_id']) ? 'selected' : ''; ?>>
                <?php echo $user['name']; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Mesa -->
        <div class="mb-3">
          <label for="table_id" class="form-label">Mesa</label>
          <select name="table_id" id="table_id" class="form-select form-select-lg" required>
            <option value="">Seleccione una mesa</option>
            <?php foreach ($viewmodel['tables'] as $table) : ?>
              <option value="<?php echo $table['id']; ?>" 
                <?php echo ($table['id'] == $viewmodel['reservation']['table_id']) ? 'selected' : ''; ?>>
                Mesa <?php echo $table['table_number']; ?> - Capacidad: <?php echo $table['capacity']; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Fecha de la reserva -->
        <div class="mb-3">
          <label for="reservation_date" class="form-label">Fecha</label>
          <input 
            type="date" 
            name="reservation_date" 
            id="reservation_date" 
            class="form-control form-control-lg" 
            value="<?php echo $viewmodel['reservation']['reservation_date']; ?>" 
            required 
          />
        </div>

        <!-- Hora de la reserva -->
        <div class="mb-3">
          <label for="reservation_time" class="form-label">Hora</label>
          <input 
            type="time" 
            name="reservation_time" 
            id="reservation_time" 
            class="form-control form-control-lg" 
            value="<?php echo $viewmodel['reservation']['reservation_time']; ?>" 
            required 
          />
        </div>

        <!-- Número de personas -->
        <div class="mb-3">
          <label for="num_people" class="form-label">Número de personas</label>
          <input 
            type="number" 
            name="num_people" 
            id="num_people" 
            class="form-control form-control-lg" 
            min="1" 
            max="20" 
            value="<?php echo $viewmodel['reservation']['num_people']; ?>" 
            required 
          />
        </div>

        <!-- Botones de acción -->
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-success btn-lg" name="submit">
            <i class="fas fa-save"></i> Guardar Cambios
          </button>
          
          <a href="<?php echo ROOT_PATH; ?>reservas" class="btn btn-danger btn-lg">
            <i class="fas fa-times"></i> Cancelar
          </a>
        </div>

      </form>
    </div>
  </div>
</div>
