<?php
// require_once 'models/tables.php';
class Tables extends Controller {
    
    // Mostrar todas las mesas
    protected function Index() {
        $viewModel = new TableModel();
        $tables = $viewModel->getAllTables();
        $this->returnView($tables, true);
    }

    // Agregar una nueva mesa
    protected function Add() {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'tables');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'table_number' => $_POST['table_number'],
                'capacity' => $_POST['capacity'],
                'status' => $_POST['status']
            ];

            $viewModel = new TableModel();
            if ($viewModel->addTable($data)) {
                header('Location: ' . ROOT_URL . 'tables');
            } else {
                die('Error al agregar la mesa');
            }
        }

        $this->returnView(null, true);
    }

    // Editar una mesa
    protected function Edit($id) {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'tables');
        }

        $tableModel = new TableModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'table_number' => $_POST['table_number'],
                'capacity' => $_POST['capacity'],
                'status' => $_POST['status']
            ];

            if ($tableModel->updateTable($data)) {
                header('Location: ' . ROOT_URL . 'tables');
            } else {
                die('Error al actualizar la mesa');
            }
        }

        $table = $tableModel->getTableById($id);
        $this->returnView($table, true);
    }

    // Eliminar una mesa
    protected function Delete($id) {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'tables');
        }

        $tableModel = new TableModel();
        if ($tableModel->deleteTable($id)) {
            header('Location: ' . ROOT_URL . 'tables');
        } else {
            die('Error al eliminar la mesa');
        }
    }
}
