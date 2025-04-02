<?php
class Tables extends Controller {

    protected function Index(): void {
        $tableModel = new TablesModel();
        $tables = $tableModel->getAllTables();
        $this->returnView($tables, true);
    }

    protected function Add() {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'tables');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'table_number' => $_POST['table_number'],
                'capacity' => $_POST['capacity'],
                'status' => $_POST['status']
            ];

            $tableModel = new TablesModel();
            if ($tableModel->addTable($data)) {
                header('Location: ' . ROOT_URL . 'tables');
            } else {
                die('Error al agregar la mesa');
            }
        }

        $this->returnView(null, true);
    }

    protected function Edit($id) {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'tables');
            exit;
        }

        $tableModel = new TablesModel();

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

    protected function Delete($id) {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'tables');
            exit;
        }

        $tableModel = new TablesModel();
        if ($tableModel->deleteTable($id)) {
            header('Location: ' . ROOT_URL . 'tables');
        } else {
            die('Error al eliminar la mesa');
        }
    }
}
?>
