<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Mi Perfil</h3>
    </div>
    <div class="panel-body">
        <form method="post" action="<?php echo ROOT_URL; ?>usuarios/perfil" enctype="multipart/form-data">
            
            <!-- Imagen de perfil -->
            <div class="text-center">
                <img src="/restaurante/assets/img/<?php echo $_SESSION['user_data']['profile_image'] ?? 'user.png'; ?>" 
                     alt="Foto de perfil" class="img-thumbnail" style="width: 150px; height: 150px;">
                <br>
                <label for="profile_image" class="btn btn-info">Cambiar Foto</label>
                <input type="file" name="profile_image" id="profile_image" class="form-control" style="display: none;">
            </div>

            <br>

            <!-- Nombre -->
            <div class="form-group">
                <label for="name">Nombre</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="form-control" 
                    value="<?php echo $_SESSION['user_data']['name']; ?>" 
                    required 
                />
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control" 
                    value="<?php echo $_SESSION['user_data']['email']; ?>" 
                    required 
                />
            </div>

            <!-- Contraseña (Opcional) -->
            <div class="form-group">
                <label for="password">Nueva Contraseña (opcional)</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="form-control" 
                />
            </div>

            <!-- Botón de Guardar Cambios -->
            <input class="btn btn-primary" name="submit" type="submit" value="Guardar Cambios" />
            <a class="btn btn-danger" href="<?php echo ROOT_URL; ?>">Cancelar</a>
        </form>
    </div>
</div>
