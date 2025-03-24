<?php
class UserModel extends Model{

    public function Index()
    {
        // Consulta todas las reservas ordenadas por fecha de creación de forma descendente
        $this->query('SELECT * FROM users ORDER BY name DESC');
        $rows = $this->resultSet();
        return $rows;
    }
    public function getUserById($id) {
        $this->query("SELECT * FROM users WHERE id = :id");
        $this->bind(':id', $id);
        return $this->single();
    }
    public function getUsers($query = '') {
        if (!empty($query)) {
            $sql = "SELECT * FROM users WHERE name LIKE :query OR email LIKE :query ORDER BY id DESC";
            $this->query($sql);
            $this->bind(':query', "%$query%");
        } else {
            $this->query("SELECT * FROM users ORDER BY id DESC");
        }
        return $this->resultSet();
    }
    public function updateUser($id, $name, $email) {
        $this->query("UPDATE users SET name = :name, email = :email WHERE id = :id");
        $this->bind(':id', $id);
        $this->bind(':name', $name);
        $this->bind(':email', $email);
        return $this->execute();
    }

    public function deleteUser($id) {
        $this->query("DELETE FROM users WHERE id = :id");
        $this->bind(':id', $id);
        return $this->execute();
    }

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
                    Messages::setMsg('Registro exitoso', 'success');
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
                    Messages::setMsg('Bienvenido', 'success');
                    exit;
                    
                } else {
                    echo 'Datos de acceso incorrectos.';
                    Messages::setMsg('Datos de acceso incorrectos', 'error');
                }
            } else {
                Messages::setMsg('Por favor, completa todos los campos', 'error');

            }
        }
        
        return;


    }
}
