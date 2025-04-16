<?php
class TablesModel extends Model
{
    public function Index()
    {
        $this->query('SELECT * FROM tables ORDER BY table_number ASC');
        return $this->resultSet();
    }
    public function getAvailableTables()
    {
        $this->query('SELECT * FROM tables WHERE status = "disponible" ORDER BY table_number ASC');
        return $this->resultSet();
    }

    public function getById($id)
    {
        $this->query('SELECT * FROM tables WHERE id = :id');
        $this->bind(':id', $id);
        return $this->single();
    }

    public function update($id, $data)
    {
        // Validar datos
        if (empty($data['table_number']) || empty($data['capacity']) || empty($data['status'])) {
            Messages::setMsg('Por favor completa todos los campos', 'error');
            return false;
        }
    
        $this->query('UPDATE tables SET table_number = :table_number, 
                      capacity = :capacity, status = :status WHERE id = :id');
        
        $this->bind(':table_number', $data['table_number']);
        $this->bind(':capacity', $data['capacity']);
        $this->bind(':status', $data['status']);
        $this->bind(':id', $id);
    
        if ($this->execute()) {
            Messages::setMsg('Mesa actualizada exitosamente', 'success');
            return true;
        }
        
        Messages::setMsg('Error al actualizar la mesa', 'error');
        return false;
    }

    public function add()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if ($post && !empty($post['table_number']) && !empty($post['capacity']) && !empty($post['location']) && !empty($post['status'])) {
            $this->query('INSERT INTO tables (table_number, capacity, location, status) 
                          VALUES (:table_number, :capacity, :location, :status)');
            $this->bind(':table_number', $post['table_number']);
            $this->bind(':capacity', $post['capacity']);
            $this->bind(':location', $post['location']);
            $this->bind(':status', $post['status']);

            $this->execute();

            if ($this->lastInsertId()) {
                Messages::setMsg('Mesa añadida exitosamente', 'success');
                return true;
            }
        } else {
            Messages::setMsg('Por favor, completa todos los campos.', 'error');
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
