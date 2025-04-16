<?php
require_once 'models/tables.php';

class Reservas extends Controller{
    
	
	protected function Index()
    {
        $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
        file_put_contents('debug.log', "Valor de búsqueda recibido en controlador: '$searchQuery'\n", FILE_APPEND);
        
        $viewmodel = new ReservaModel();
        $this->returnView($viewmodel->search($searchQuery), true);
    }
	public function searchReservations()
    {
        $query = isset($_POST['search']) ? trim($_POST['search']) : '';
        $reservasModel = new ReservaModel();
        $reservas = $reservasModel->getReservations($query);
        
        echo json_encode($reservas);
        exit;
    }
    protected function add()
    {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'reservas');
            exit;
        }
    
        // Modelos de usuarios y mesas
        $usersModel = new UserModel();
        $tablesModel = new TablesModel();
        $reservaModel = new ReservaModel();
    
        $data = [
            'users' => $usersModel->Index(),
            'tables' => $tablesModel->getAvailableTables()
        ];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            if ($reservaModel->add($post)) {
                header('Location: ' . ROOT_URL . 'reservas');
                exit;
            }
        }
    
        $this->returnView($data, true);
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
            header('Location: ' . ROOT_URL . 'reservations');
            exit;
        }
    
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            $_SESSION['error_msg'] = 'ID de reservación inválido';
            header('Location: ' . ROOT_URL . 'reservations');
            exit;
        }
    
        $reservationModel = new ReservaModel();
        $reservation = $reservationModel->getById($id);
        
        if (!$reservation) {
            $_SESSION['error_msg'] = 'Reservación no encontrada';
            header('Location: ' . ROOT_URL . 'reservations');
            exit;
        }
    
        // Cargar datos necesarios para el formulario
        $usersModel = new UserModel();
        $tablesModel = new TablesModel();
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitizar entrada
            $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            if ($reservationModel->update($id, $data)) {
                $_SESSION['success_msg'] = 'Reservación actualizada correctamente';
                header('Location: ' . ROOT_URL . 'reservations');
                exit;
            } else {
                $_SESSION['error_msg'] = 'Error al actualizar la reservación';
            }
        }
    
        $this->returnView([
            'reservation' => $reservation,
            'users' => $usersModel->getUsers(),
            'tables' => $tablesModel->getAvailableTables()
        ], true);
    }
}