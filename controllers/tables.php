<?php
class Tables extends Controller
{

    protected function Index(): void
    {
        $tableModel = new TablesModel();
        $tables = $tableModel->getAllTables();
        $this->returnView($tables, true);
    }

    protected function Add()
    {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'tables');
            exit;
        }
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'table_number' => $_POST['table_number'],
                'capacity' => $_POST['capacity'],
                'status' => $_POST['status'],
                'location' => $_POST['location'],
            ];

            $tableModel = new TablesModel();
            if ($tableModel->tableNumberExists($data['table_number'])) {
                $error = "Ya existe una mesa con ese número.";
            } elseif ($tableModel->addTable($data)) {
                $_SESSION['message'] = 'Tabla Añadida exitosamente.';

                header('Location: ' . ROOT_URL . 'tables');
                exit;
            } else {
                $error = "Error al agregar la mesa.";
            }
        }

        $this->returnView(['error' => $error], true);
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

        $model = new TablesModel();
        $table = $model->getTableById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'table_number' => $_POST['table_number'],
                'capacity' => $_POST['capacity'],
                'location' => $_POST['location'],
                'status' => $_POST['status']
            ];

            if ($model->updateTable($data)) {
                $_SESSION['message'] = 'Mesa actualizada exitosamente.';
                header('Location: ' . ROOT_URL . 'tables');
                exit;
            } else {
                $_SESSION['message'] = 'Error al actualizar la mesa.';
            }
        }

        $this->returnView($table, true);
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
