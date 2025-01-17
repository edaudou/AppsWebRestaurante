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

        if (isset($post['submit']) && $post['submit']) {
            // Validar que todos los campos requeridos estén presentes
            if (
                !empty($post['reservation_date']) &&
                !empty($post['reservation_time']) &&
                !empty($post['num_people'])
            ) {
                // Insertar datos en la tabla 'reservations'
                $this->query('INSERT INTO reservations (user_id, reservation_date, reservation_time, num_people) VALUES (:user_id, :reservation_date, :reservation_time, :num_people)');
                $this->bind(':user_id', $_SESSION['user_id']); // El usuario logueado
                $this->bind(':reservation_date', $post['reservation_date']);
                $this->bind(':reservation_time', $post['reservation_time']);
                $this->bind(':num_people', $post['num_people']);
                $this->execute();

                // Verificar si la reserva fue creada exitosamente
                if ($this->lastInsertId()) {
                    // Redirigir a la página de reservas
                    header('Location: ' . ROOT_URL . 'reservas');
                    exit;
                }
            } else {
                // Mensaje de error si faltan campos
                echo 'Por favor, completa todos los campos.';
            }
        }
        return;
    }
}
?>
