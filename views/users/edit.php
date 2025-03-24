<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Editar Usuario</h3>
    </div>
    <div class="panel-body">
        <form method="POST" action="">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($viewmodel['name']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($viewmodel['email']); ?>" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Guardar Cambios">
            <a href="<?php echo ROOT_PATH; ?>users" class="btn btn-default">Cancelar</a>
        </form>
    </div>
</div>
