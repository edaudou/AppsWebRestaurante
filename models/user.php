<?php
class UserModel extends Model{
    public function register(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post['submit']) && $post['submit']) {
            // Validar los valores necesarios
            if (isset($post['name'], $post['email'], $post['password']) && 
                !empty($post['name']) && 
                !empty($post['email']) && 
                !empty($post['password'])) {
                
                // Encriptar contraseña
                $password = md5($post['password']);
                
                // Insertar en MySQL
                $this->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
                $this->bind(':name', $post['name']);
                $this->bind(':email', $post['email']);
                $this->bind(':password', $password);
                $this->execute();

                // Verificar si se realizó el registro
                if ($this->lastInsertId()) {
                    // Redirigir
                    header('Location: '.ROOT_URL.'users/login');
                    exit;
                }
            } else {
                echo 'Por favor, completa todos los campos.';
            }
        }
        return;
    }

    public function login(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post['submit']) && $post['submit']) {
            // Validar los valores necesarios
            if (isset($post['email'], $post['password']) && 
                !empty($post['email']) && 
                !empty($post['password'])) {
                
                // Encriptar contraseña
                $password = md5($post['password']);
                
                // Consultar en la base de datos
                $this->query('SELECT * FROM users WHERE email = :email AND password = :password');
                $this->bind(':email', $post['email']);
                $this->bind(':password', $password);
                
                $row = $this->single();

                if ($row) {
                    // Iniciar sesión
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['user_data'] = array(
                        "id"    => $row['id'],
                        "name"  => $row['name'],
                        "email" => $row['email']
                    );
                    header('Location: '.ROOT_URL.'reservas');
                    exit;
                } else {
                    echo 'Datos de acceso incorrectos.';
                }
            } else {
                echo 'Por favor, completa todos los campos.';
            }
        }
        return;
    }
}
