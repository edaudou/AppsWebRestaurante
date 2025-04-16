<?php
class ReservaModel extends Model
{
    public function Index()
    {
        $this->query('SELECT r.*, u.name AS user_name, t.table_number 
                      FROM reservations r 
                      JOIN users u ON r.user_id = u.id
                      JOIN tables t ON r.table_id = t.id
                      ORDER BY r.create_date DESC');
        return $this->resultSet();
    }
    public function getReservations($query = '')
    {
        if (!empty($query)) {
            $sql = "SELECT r.*, u.name AS user_name, t.table_number 
                    FROM reservations r
                    JOIN users u ON r.user_id = u.id
                    JOIN tables t ON r.table_id = t.id
                    WHERE r.reservation_date LIKE :query 
                       OR r.reservation_time LIKE :query 
                       OR CAST(r.num_people AS CHAR) LIKE :query 
                       OR u.name LIKE :query
                       OR t.table_number LIKE :query
                    ORDER BY r.create_date DESC";
            $this->query($sql);
            $this->bind(':query', "%$query%");
        } else {
            $this->query("SELECT r.*, u.name AS user_name, t.table_number 
                          FROM reservations r
                          JOIN users u ON r.user_id = u.id
                          JOIN tables t ON r.table_id = t.id
                          ORDER BY r.reservation_date DESC");
        }
        return $this->resultSet();
    }

    public function search($query)
    {
        return $this->getReservations($query);
    }
    public function add($data)
    {
        if (!empty($data['reservation_date']) &&
            !empty($data['reservation_time']) &&
            !empty($data['num_people']) &&
            !empty($data['table_id']) &&
            !empty($data['user_id'])) {
    
            $this->query('INSERT INTO reservations (user_id, table_id, reservation_date, reservation_time, num_people, special_request) 
                          VALUES (:user_id, :table_id, :reservation_date, :reservation_time, :num_people, :special_request)');
            $this->bind(':user_id', $data['user_id']);
            $this->bind(':table_id', $data['table_id']);
            $this->bind(':reservation_date', $data['reservation_date']);
            $this->bind(':reservation_time', $data['reservation_time']);
            $this->bind(':num_people', $data['num_people']);
            $this->bind(':special_request', $data['special_request'] ?? null);
    
            $this->execute();
    
            if ($this->lastInsertId()) {
                Messages::setMsg('Reserva creada exitosamente', 'success');
                return true;
            }
        } else {
            Messages::setMsg('Por favor, completa todos los campos', 'error');
        }
    
        return false;
    }
    
    
    

    public function delete($id)
    {
        // Verifica que el ID sea válido
        if (!empty($id) && is_numeric($id)) {
            // Prepara la consulta para eliminar
            $this->query('DELETE FROM reservations WHERE id = :id');
            $this->bind(':id', $id);

            // Ejecutar la consulta
            $this->execute();
            Messages::setMsg('Reserva eliminada exitosamente', 'success');
            return true; // La reserva fue eliminada
        }
        return false; // El ID no es válido
    }
    public function getById($id)
    {
        $this->query('SELECT r.*, u.name AS user_name, t.table_number 
                      FROM reservations r
                      JOIN users u ON r.user_id = u.id
                      JOIN tables t ON r.table_id = t.id
                      WHERE r.id = :id');
        $this->bind(':id', $id);
        return $this->single();
    }
    //Modificar reserva
    public function update($id, $data)
    {
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
        if (!empty($data['reservation_date']) &&
            !empty($data['reservation_time']) &&
            !empty($data['num_people']) &&
            !empty($data['table_id']) &&
            !empty($data['user_id'])) {
    
            $this->query('UPDATE reservations SET reservation_date = :reservation_date, reservation_time = :reservation_time, 
                          num_people = :num_people, special_request = :special_request, 
                          table_id = :table_id, user_id = :user_id WHERE id = :id');
            $this->bind(':reservation_date', $data['reservation_date']);
            $this->bind(':reservation_time', $data['reservation_time']);
            $this->bind(':num_people', $data['num_people']);
            $this->bind(':special_request', $data['special_request'] ?? null);
            $this->bind(':table_id', $data['table_id']);
            $this->bind(':user_id', $data['user_id']);
            $this->bind(':id', $id);
    
            $this->execute();
            Messages::setMsg('Reserva actualizada exitosamente', 'success');
            return true;
        }
    
        return false;
    }
    

    public function getFechasOcupadas()
    {
        $this->query('SELECT reservation_date FROM reservations');
        $rows = $this->resultSet();
        return array_column($rows, 'reservation_date');
    }
}