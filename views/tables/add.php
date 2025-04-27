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
          required />
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
          required />
      </div>

      <!-- Ubicación -->
      <div class="mb-3">
          <div class="mb-3">
            <div class="mb-3">
              <label for="location_id" class="form-label">Ubicación</label>
              <select name="location_id" id="location_id" class="form-select form-select-lg" required>
                <option value="">Seleccione una ubicación</option>
                <?php foreach ($viewmodel['locations'] as $location): ?>
                  <option value="<?php echo $location['id']; ?>">
                    <?php echo $location['name']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

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
        value="Guardar" />
      <a
        class="btn btn-danger"
        href="<?php echo ROOT_PATH; ?>tables">
        Cancelar
      </a>
    </form>
  </div>
</div>