<?php
class Tables extends Controller
{

    protected function Index()
    {
        $viewmodel = new TablesModel();
        $this->returnView($viewmodel->Index(), true);
    }

    protected function add()
    {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'tables');
            exit;
        }

        $model = new TablesModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($model->add()) {
                header('Location: ' . ROOT_URL . 'tables');
                exit;
            }
        }

        $this->returnView([], true);
    }

    protected function edit()
    {
        if (!isset($_SESSION['is_logged_in'])) {
            $_SESSION['error_msg'] = 'Debes iniciar sesión para editar mesas';
            header('Location: ' . ROOT_URL . 'tables');
            exit;
        }
    
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            $_SESSION['error_msg'] = 'ID de mesa no válido';
            header('Location: ' . ROOT_URL . 'tables');
            exit;
        }
    
        $model = new TablesModel();
        $table = $model->getById($id);
    
        if (!$table) {
            $_SESSION['error_msg'] = 'Mesa no encontrada';
            header('Location: ' . ROOT_URL . 'tables');
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($model->update($id, $_POST)) {
                $_SESSION['success_msg'] = 'Mesa actualizada correctamente';
                header('Location: ' . ROOT_URL . 'tables');
                exit;
            }
        }
    
        $this->returnView(['table' => $table], true);
    }



	protected function delete() {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'tables');
            exit;
        }
    
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    
        if ($id) {
            $model = new TablesModel();
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
