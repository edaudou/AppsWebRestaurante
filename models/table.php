<?php
class TableModel extends Model
{

    public function getAllTables()
    {
        $this->query("SELECT * FROM tables ORDER BY table_number ASC");
        return $this->resultSet();
    }
    public function getTables($query = '')
    {
        if (!empty($query)) {
            $sql = "SELECT * FROM tables 
                    WHERE table_number LIKE :query 
                       OR status LIKE :query 
                       OR CAST(capacity AS CHAR) LIKE :query 
                    ORDER BY table_number ASC";
            $this->query($sql);
            $this->bind(':query', "%$query%");
        } else {
            $this->query("SELECT * FROM tables ORDER BY table_number ASC");
        }

        return $this->resultSet();
    }

    public function getAvailableTables()
    {
        $this->query("SELECT * FROM tables WHERE status = 'Disponible' ORDER BY table_number ASC");
        return $this->resultSet();
    }

    public function getTableById($id)
    {
        $this->query("SELECT * FROM tables WHERE id = :id");
        $this->bind(':id', $id);
        return $this->single();
    }

    public function addTable($data)
    {
        $this->query("INSERT INTO tables (table_number, capacity, status, location) VALUES (:table_number, :capacity, :status, :location)");
        $this->bind(':table_number', $data['table_number']);
        $this->bind(':capacity', $data['capacity']);
        $this->bind(':status', $data['status']);
        $this->bind(':location', $data['location']);
        return $this->execute();
    }
    public function add()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (
            !empty($post['table_number']) &&
            !empty($post['capacity']) &&
            !empty($post['status']) &&
            !empty($post['location_id'])
        ) {
            // Evita duplicados
            if ($this->tableNumberExists($post['table_number'])) {
                Messages::setMsg('Ya existe una mesa con ese número.', 'error');
                return false;
            }

            $this->query("INSERT INTO tables (table_number, capacity, status, location_id)
                      VALUES (:table_number, :capacity, :status, :location_id)");
            $this->bind(':table_number', $post['table_number']);
            $this->bind(':capacity', $post['capacity']);
            $this->bind(':status', $post['status']);
            $this->bind(':location_id', $post['location_id']);

            $this->execute();

            if ($this->lastInsertId()) {
                Messages::setMsg('Mesa creada exitosamente', 'success');
                return true;
            }
        } else {
            Messages::setMsg('Por favor, completa todos los campos', 'error');
        }

        return false;
    }
    public function tableNumberExists($table_number)
    {
        $this->query("SELECT COUNT(*) as total FROM tables WHERE table_number = :table_number");
        $this->bind(':table_number', $table_number);
        $result = $this->single();
        return $result['total'] > 0;
    }


    public function update($id, $data)
    {
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (
            !empty($data['table_number']) &&
            !empty($data['capacity']) &&
            !empty($data['location_id']) &&
            !empty($data['status'])
        ) {

            $this->query("UPDATE tables SET 
                            table_number = :table_number, 
                            capacity = :capacity, 
                            location_id = :location_id, 
                            status = :status 
                          WHERE id = :id");
            $this->bind(':table_number', $data['table_number']);
            $this->bind(':capacity', $data['capacity']);
            $this->bind(':location_id', $data['location_id']);
            $this->bind(':status', $data['status']);
            $this->bind(':id', $id);

            $this->execute();
            Messages::setMsg('Mesa actualizada exitosamente', 'success');
            return true;
        }

        return false;
    }


    public function deleteTable($id)
    {
        // Verifica que el ID sea válido
        if (!empty($id) && is_numeric($id)) {
            // Prepara la consulta para eliminar
            $this->query('DELETE FROM tables WHERE id = :id');
            $this->bind(':id', $id);

            // Ejecutar la consulta
            $this->execute();
            Messages::setMsg('Mesa eliminada exitosamente', 'success');
            return true; // La reserva fue eliminada
        }
        return false; // El ID no es válido
    }
    public function getAllLocations()
    {
        $this->query("SELECT * FROM locations ORDER BY name ASC");
        return $this->resultSet();
    }
}
