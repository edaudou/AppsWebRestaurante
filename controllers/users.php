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
