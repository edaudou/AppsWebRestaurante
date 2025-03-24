<?php
class Reservas extends Controller{
	protected function Index(){
		$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : ''; 
		file_put_contents('debug.log', "Valor de búsqueda recibido en controlador: '$searchQuery'\n", FILE_APPEND);
		$viewmodel = new ReservaModel();
		$this->returnView($viewmodel->search($searchQuery), true);
	}
	public function searchReservations() {
        $query = isset($_POST['search']) ? trim($_POST['search']) : '';
        $reservasModel = new ReservaModel();
        $reservas = $reservasModel->getReservations($query);
        
        echo json_encode($reservas);
        exit;
    }
	protected function add(){
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'reservas');
		}
	// 	$reservasModel = new ReservaModel();
    // $usersModel = new UserModel();
    // $tablesModel = new TableModel();

    // $data = [
    //     'users' => $usersModel->getAllUsers(),
    //     'tables' => $tablesModel->getAvailableTables()
    // ];
		file_put_contents('debug.log', print_r($_POST, true));
		$viewmodel = new ReservaModel();
		$this->returnView($viewmodel->add(), true);
	}
	protected function delete() {
		if (!isset($_SESSION['is_logged_in'])) {
			header('Location: ' . ROOT_URL . 'reservas');
			exit;
		}
	
		// Obtiene el ID de la reserva a eliminar
		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

		if ($id) {
			$viewmodel = new ReservaModel();
			$result = $viewmodel->delete($id);
	
			if ($result) {
				// Mensaje de éxito (opcional)
				$_SESSION['message'] = 'Reserva eliminada exitosamente.';
			} else {
				// Mensaje de error (opcional)
				$_SESSION['message'] = 'No se pudo eliminar la reserva. Verifica el ID.';
			}
		} else {
			$_SESSION['message'] = 'ID de reserva no válido.';
		}
	
		// Redirige de vuelta a la lista de reservas
		header('Location: ' . ROOT_URL . 'reservas');
		exit;
	}
	protected function edit() {
    if (!isset($_SESSION['is_logged_in'])) {
        header('Location: ' . ROOT_URL . 'reservas');
        exit;
    }

    // Obtén el ID de la reserva desde la URL
	$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($id) {
        $viewmodel = new ReservaModel();

        // Si se envió el formulario, procesar la actualización
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $viewmodel->update($id, $_POST);

            if ($result) {
                $_SESSION['message'] = 'Reserva actualizada exitosamente.';
                header('Location: ' . ROOT_URL . 'reservas');
                exit;
            } else {
                $_SESSION['message'] = 'Error al actualizar la reserva. Verifica los datos.';
            }
        }

        // Obtener los datos de la reserva para mostrarlos en el formulario
        $reservation = $viewmodel->getById($id);
        $this->returnView($reservation, true);
    } else {
        $_SESSION['message'] = 'ID de reserva no válido.';
        header('Location: ' . ROOT_URL . 'reservas');
        exit;
    }
}

}