<?php
class ReservaModel extends Model {
    public function Index() {
        // Consulta todas las reservas ordenadas por fecha de creación de forma descendente
        $this->query('SELECT * FROM reservations ORDER BY create_date DESC');
        $rows = $this->resultSet();
        return $rows;
    }

    public function add() {
        // Sanitizar datos del formulario
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        file_put_contents('debug.log', print_r($post, true));
        if (isset($post['submit']) && $post['submit']) {
            // Validar que todos los campos requeridos estén presentes
            if (
                !empty($post['reservation_date']) &&
                !empty($post['reservation_time']) &&
                !empty($post['num_people'])
            ) {
                file_put_contents('debug.log', "Datos validados:\n" . print_r($post, true), FILE_APPEND);
                // Insertar datos en la tabla 'reservations'
                $this->query('INSERT INTO reservations (user_id, reservation_date, reservation_time, num_people) VALUES (:user_id, :reservation_date, :reservation_time, :num_people)');
                $this->bind(':user_id', 1); // Usuario logueado
                $this->bind(':reservation_date', $post['reservation_date']);
                $this->bind(':reservation_time', $post['reservation_time']);
                $this->bind(':num_people', $post['num_people']);
                // Ejecutar la consulta

                $this->execute();

                // Verificar si la reserva fue creada exitosamente
                if ($this->lastInsertId()) {
                    file_put_contents('debug.log', "Reserva creada exitosamente\n", FILE_APPEND);
                    // Redirigir a la página de reservas
                    header('Location: ' . ROOT_URL . 'reservas');
                    exit;
                }} else {
                    file_put_contents('debug.log', "Error al insertar en la base de datos\n", FILE_APPEND);
                }
            } else {
                

                echo 'Por favor, completa todos los campos.';
            }
            return;
        }
        public function delete($id) {
            // Verifica que el ID sea válido
            if (!empty($id) && is_numeric($id)) {
                // Prepara la consulta para eliminar
                $this->query('DELETE FROM reservations WHERE id = :id');
                $this->bind(':id', $id);
        
                // Ejecutar la consulta
                $this->execute();
        
            }
            return false; // El ID no es válido
        }
        public function getById($id) {
            $this->query('SELECT * FROM reservations WHERE id = :id');
            $this->bind(':id', $id);
            return $this->single(); // Devuelve solo un registro
        }
        //Modificar reserva
        public function update($id, $data) {
            // Sanitizar datos del formulario
            $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
            if (
                !empty($data['reservation_date']) &&
                !empty($data['reservation_time']) &&
                !empty($data['num_people'])
            ) {
                $this->query('UPDATE reservations SET reservation_date = :reservation_date, reservation_time = :reservation_time, num_people = :num_people WHERE id = :id');
                $this->bind(':reservation_date', $data['reservation_date']);
                $this->bind(':reservation_time', $data['reservation_time']);
                $this->bind(':num_people', $data['num_people']);
                $this->bind(':id', $id);
        
                // Ejecutar la consulta
                $this->execute();
        
                return true;
            }
        
            return false; // Si los campos están vacíos o no se cumple alguna condición
        }
        
        
 
        
}
?>
