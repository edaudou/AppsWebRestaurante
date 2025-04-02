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

        // Cargar modelos de usuarios y mesas
        $usersModel = new UserModel();
        $tablesModel = new TablesModel();

        $viewmodel = new ReservaModel();

        // Obtener usuarios y mesas disponibles
        $data = [
            'users' => $usersModel->Index(),
            'tables' => $tablesModel->getAvailableTables()
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $viewmodel->add();
            header('Location: ' . ROOT_URL . 'reservas');
            exit;
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
    protected function edit()
    {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'reservas');
            exit;
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            $_SESSION['message'] = 'ID de reserva no válido.';
            header('Location: ' . ROOT_URL . 'reservas');
            exit;
        }

        // Cargar modelos de usuarios y mesas
        $usersModel = new UserModel();
        $tablesModel = new TablesModel();

        $viewmodel = new ReservaModel();
        $reservation = $viewmodel->getById($id);

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

        $data = [
            'reservation' => $reservation,
            'users' => $usersModel->Index(),
            'tables' => $tablesModel->getAvailableTables()
        ];

        $this->returnView($data, true);
    }
}