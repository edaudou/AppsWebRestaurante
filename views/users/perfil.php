<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Perfil de Usuario</h3>
    </div>
    <div class="panel-body">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <div class="text-center">
            <img src="/restaurante/assets/img/<?php echo $viewmodel['profile_image'] ?? 'user.png'; ?>" 
                 alt="Foto de perfil" class="img-thumbnail" style="width: 150px; height: 150px;">
            <form method="post" action="<?php echo ROOT_URL; ?>usuarios/actualizarFoto" enctype="multipart/form-data">
                <input type="file" name="profile_image" class="form-control">
                <button type="submit" class="btn btn-primary btn-sm">Actualizar Foto</button>
            </form>
        </div>

        <form method="post" action="<?php echo ROOT_URL; ?>usuarios/perfil">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="name" class="form-control" value="<?php echo $viewmodel['name']; ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $viewmodel['email']; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
        </form>
    </div>
</div>
