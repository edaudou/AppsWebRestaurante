<div class="container mt-4">
  <div class="card shadow-lg">
    <div class="card-header bg-primary text-white">
      <h3 class="card-title mb-0">Editar Mesa</h3>
    </div>
    <div class="card-body">
      <form method="post" action="">

        <!-- Número de Mesa -->
        <div class="mb-3">
          <label for="table_number" class="form-label">Número de Mesa</label>
          <input 
            type="text" 
            name="table_number" 
            id="table_number" 
            class="form-control form-control-lg" 
            value="<?php echo $viewmodel['table']['table_number']; ?>" 
            required 
          />
        </div>

        <!-- Capacidad -->
        <div class="mb-3">
          <label for="capacity" class="form-label">Capacidad</label>
          <input 
            type="number" 
            name="capacity" 
            id="capacity" 
            class="form-control form-control-lg" 
            min="1" 
            value="<?php echo $viewmodel['table']['capacity']; ?>" 
            required 
          />
        </div>
        <!-- Capacidad -->
        <div class="mb-3">
          <label for="location" class="form-label">location</label>
          <input 
            type="text" 
            name="location" 
            id="location" 
            class="form-control form-control-lg" 
            min="1" 
            value="<?php echo $viewmodel['table']['location']; ?>" 
            required 
          />
        </div>
        <!-- Estado -->
        <div class="mb-3">
          <label for="status" class="form-label">Estado</label>
          <select name="status" id="status" class="form-select form-select-lg" required>
            <option value="Disponible" <?php echo ($viewmodel['table']['status'] == 'Disponible') ? 'selected' : ''; ?>>
              Disponible
            </option>
            <option value="Ocupada" <?php echo ($viewmodel['table']['status'] == 'Ocupada') ? 'selected' : ''; ?>>
              Ocupada
            </option>
          </select>
        </div>

        <!-- Botones de acción -->
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-success btn-lg" name="submit">
            <i class="fas fa-save"></i> Guardar Cambios
          </button>
          
          <a href="<?php echo ROOT_PATH; ?>tables" class="btn btn-danger btn-lg">
            <i class="fas fa-times"></i> Cancelar
          </a>
        </div>

      </form>
    </div>
  </div>
</div>
