<?php
class Users extends Controller{
	protected function Index(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->Index(), true);
	}
	protected function register(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->register(), true);
	}
    protected function perfil() {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'users/login');
            exit;
        }

        $id = $_SESSION['user_data']['id']; 
        $userModel = new UserModel();
        $user = $userModel->getUserById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email']
            ];
            $userModel->updateUser($id, $data);
            $_SESSION['message'] = 'Perfil actualizado correctamente.';
            header('Location: ' . ROOT_URL . 'usuarios/perfil');
            exit;
        }

        $this->returnView($user, true);
    }

    protected function actualizarFoto() {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'users/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_image'])) {
            $id = $_SESSION['user_data']['id'];
            $targetDir = "assets/img/";
            $imagePath = $targetDir . basename($_FILES["profile_image"]["name"]);
            move_uploaded_file($_FILES["profile_image"]["tmp_name"], $imagePath);

            $userModel = new UserModel();
            $userModel->updateProfileImage($id, basename($_FILES["profile_image"]["name"]));

            $_SESSION['message'] = 'Foto de perfil actualizada.';
            header('Location: ' . ROOT_URL . 'usuarios/perfil');
            exit;
        }
    }
	protected function login(){
		$viewmodel = new UserModel();
		$this->returnView($viewmodel->login(), true);
	}
    public function searchUsers() {
        $query = isset($_POST['search']) ? trim($_POST['search']) : '';
        $userModel = new UserModel();
        $users = $userModel->getUsers($query);
        
        echo json_encode($users);
        exit;
    }
	protected function logout(){
		unset($_SESSION['is_logged_in']);
		unset($_SESSION['user_data']);

		session_destroy();
		// Redirect
		Messages::setMsg('Logged out', 'success');
		header('Location: '.ROOT_URL);
	}
	protected function Edit() {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'users');
            return;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . ROOT_URL . 'users');
            return;
        }

        $userModel = new UserModel();
        $user = $userModel->getUserById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';

            if (!empty($name) && !empty($email)) {
                $userModel->updateUser($id, $name, $email);
                header('Location: ' . ROOT_URL . 'users');
            }
        }

        $this->returnView($user, true);
    }

    protected function Delete() {
        if (!isset($_SESSION['is_logged_in'])) {
            header('Location: ' . ROOT_URL . 'users');
            return;
        }

        $id = $_GET['id'] ?? null;
        if ($id) {
            $userModel = new UserModel();
            $userModel->deleteUser($id);
        }

        header('Location: ' . ROOT_URL . 'users');
    }
}
