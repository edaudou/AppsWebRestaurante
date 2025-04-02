<div class="container">
    <h2 class="mt-4">Gestión de Mesas</h2>
    
    <!-- Botón para añadir nueva mesa -->
    <a href="<?php echo ROOT_URL; ?>tables/add" class="btn btn-success mb-3">Añadir Mesa</a>
    
    <!-- Tabla de mesas -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Número de Mesa</th>
                <th>Capacidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($viewmodel as $table): ?>
                <tr>
                    <td><?php echo $table['id']; ?></td>
                    <td><?php echo $table['table_number']; ?></td>
                    <td><?php echo $table['capacity']; ?> personas</td>
                    <td>
                        <span class="badge badge-<?php echo ($table['status'] == 'Disponible') ? 'success' : 'danger'; ?>">
                            <?php echo $table['status']; ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?php echo ROOT_URL; ?>tables/edit?id=<?php echo $table['id']; ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="<?php echo ROOT_URL; ?>tables/delete?id=<?php echo $table['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar esta mesa?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
