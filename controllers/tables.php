<?php
class Tables extends Controller
{

    protected function Index(): void
    {
        $tableModel = new TableModel();
        $tables = $tableModel->getAllTables();
        $this->returnView($tables, true);
    }


    protected function add()
    {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'tables');
            exit;
        }
    
        $viewmodel = new TableModel();
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($viewmodel->add()) {
                header('Location: ' . ROOT_URL . 'tables');
                exit;
            }
        }
    
        // Cargar ubicaciones para el formulario
        $locations = $viewmodel->getAllLocations();
    
        $this->returnView(['locations' => $locations], true);
    }
    
    
	public function searchTables()
    {
        $query = isset($_POST['search']) ? trim($_POST['search']) : '';
        $reservasModel = new TableModel();
        $reservas = $reservasModel->getTables($query);
        
        echo json_encode($reservas);
        exit;
    }
    
    protected function edit()
    {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'tables');
            exit;
        }
    
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            $_SESSION['message'] = 'ID de mesa no válido.';
            header('Location: ' . ROOT_URL . 'tables');
            exit;
        }
    
        $model = new TableModel();
        $table = $model->getTableById($id);
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $model->update($id, $_POST);
    
            if ($result) {
                $_SESSION['message'] = 'Mesa actualizada exitosamente.';
                header('Location: ' . ROOT_URL . 'tables');
                exit;
            } else {
                $_SESSION['message'] = 'Error al actualizar la mesa. Verifica los datos.';
            }
        }
    
        // Cargar ubicaciones para el formulario
        $locations = $model->getAllLocations();
    
        $this->returnView(['table' => $table, 'locations' => $locations], true);
    }
    

	protected function delete() {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'tables');
            exit;
        }
    
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    
        if ($id) {
            $model = new TableModel();
            $result = $model->deleteTable($id);
    
            if ($result) {
                $_SESSION['message'] = 'Mesa eliminada exitosamente.';
            } else {
                $_SESSION['message'] = 'No se pudo eliminar la mesa. Verifica el ID.';
            }
        } else {
            $_SESSION['message'] = 'ID de mesa no válido.';
        }
    
        header('Location: ' . ROOT_URL . 'tables');
        exit;
    }
    
}
