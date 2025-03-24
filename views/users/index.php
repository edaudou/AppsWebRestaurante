<div>
	<a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>users/register">Crear Usuario</a>

	<!-- Barra de búsqueda -->
	<form method="GET" action="<?php echo ROOT_PATH; ?>users">
        <input type="text" name="search" placeholder="Buscar usuario..." class="form-control" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" />
		<button type="submit" class="btn btn-primary">Buscar</button>
	</form>

	<?php foreach ($viewmodel as $item) : ?>
        <div class="well">
            <h3>Nombre: <?php echo $item['name']; ?></h3>
            <small>Email: <?php echo $item['email']; ?></small>
            <hr />
            <br />
            <a class="btn btn-primary" href="<?php echo ROOT_PATH; ?>users/edit/<?php echo $item['id']; ?>">Editar</a>
            <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>users/delete/<?php echo $item['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>
        </div>
    <?php endforeach; ?>
</div>
<div>
    <a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>users/register">Crear Usuario</a>

    <input type="text" id="searchUser" placeholder="Buscar usuario..." class="form-control" />

    <div id="userResults">
        <!-- Aquí se mostrarán los resultados de la búsqueda -->
    </div>
</div>

<script>
document.getElementById('searchUser').addEventListener('keyup', function() {
    let searchQuery = this.value;
    let xhr = new XMLHttpRequest();
    
    xhr.open('POST', '<?php echo ROOT_URL; ?>users/searchUsers', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if (this.status === 200) {
            let users = JSON.parse(this.responseText);
            let output = '';

            if (users.length > 0) {
                users.forEach(user => {
                    output += `<div class="well">
                        <h3>${user.name}</h3>
                        <small>${user.email}</small>
                        <hr />
                        <a class="btn btn-primary" href="<?php echo ROOT_PATH; ?>users/edit?id=${user.id}">Editar</a>
                        <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>users/delete?id=${user.id}" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                    </div>`;
                });
            } else {
                output = '<p>No se encontraron resultados.</p>';
            }

            document.getElementById('userResults').innerHTML = output;
        }
    };

    xhr.send('search=' + searchQuery);
});
</script>
