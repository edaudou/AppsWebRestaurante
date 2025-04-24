<div class="container">
    <h2 class="mt-4">Gestión de Mesas</h2>

    <!-- Botón para añadir nueva mesa -->
    <a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>tables/add">Añadir Mesa</a>

    <!-- Barra de búsqueda con AJAX -->
    <input type="text" id="searchTable" placeholder="Buscar mesa..." class="form-control mt-3 mb-3" />

    <!-- Resultados de búsqueda -->
    <div id="tableResults">
        <?php foreach ($viewmodel as $table): ?>
            <div class="well">
                <h3>Mesa Nº: <?php echo $table['table_number']; ?></h3>
                <p><strong>Capacidad:</strong> <?php echo $table['capacity']; ?> personas</p>
                <p><strong>Localizacion:</strong><?php echo $table['location']; ?> </p>

                <p><strong>Estado:</strong> 
                    <span class="badge badge-<?php echo ($table['status'] == 'Disponible') ? 'success' : 'danger'; ?>">
                        <?php echo $table['status']; ?>
                    </span>
                </p>
                <a class="btn btn-primary" href="<?php echo ROOT_PATH; ?>tables/edit/<?php echo $table['id']; ?>">Editar</a>
                <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>tables/delete/<?php echo $table['id']; ?>" onclick="return confirm('¿Seguro que quieres eliminar esta mesa?');">Eliminar</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
document.getElementById('searchTable').addEventListener('keyup', function () {
    let searchQuery = this.value;
    let xhr = new XMLHttpRequest();

    xhr.open('POST', '<?php echo ROOT_URL; ?>tables/searchTables', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.status === 200) {
            let tables = JSON.parse(this.responseText);
            let output = '';

            if (tables.length > 0) {
                tables.forEach(table => {
                    output += `<div class="well">
                        <h3>Mesa Nº: ${table.table_number}</h3>
                        <p><strong>Capacidad:</strong> ${table.capacity} personas</p>
                        <p><strong>Localizacion:</strong> ${table.location} personas</p>
                        <p><strong>Estado:</strong> 
                            <span class="badge badge-${table.status === 'Disponible' ? 'success' : 'danger'}">
                                ${table.status}
                            </span>
                        </p>
                        <a class="btn btn-primary" href="<?php echo ROOT_PATH; ?>tables/edit?id=${table.id}">Editar</a>
                        <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>tables/delete?id=${table.id}" onclick="return confirm('¿Seguro que quieres eliminar esta mesa?');">Eliminar</a>
                    </div>`;
                });
            } else {
                output = '<p>No se encontraron mesas.</p>';
            }

            document.getElementById('tableResults').innerHTML = output;
        }
    };

    xhr.send('search=' + searchQuery);
});
</script>
