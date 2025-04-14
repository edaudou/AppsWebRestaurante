<?php
class TablesModel extends Model
{

    public function getAllTables()
    {
        $this->query("SELECT * FROM tables ORDER BY table_number ASC");
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
    public function tableNumberExists($table_number)
    {
        $this->query("SELECT COUNT(*) as total FROM tables WHERE table_number = :table_number");
        $this->bind(':table_number', $table_number);
        $result = $this->single();
        return $result['total'] > 0;
    }


    public function updateTable($data)
    {
        $this->query("UPDATE tables SET table_number = :table_number, capacity = :capacity, location = :location, status = :status WHERE id = :id");
        $this->bind(':id', $data['id']);
        $this->bind(':table_number', $data['table_number']);
        $this->bind(':capacity', $data['capacity']);
        $this->bind(':location', $data['location']);
        $this->bind(':status', $data['status']);
        return $this->execute();
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
}
