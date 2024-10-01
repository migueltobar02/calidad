<?php
require_once 'models/UserModel.php';
require_once 'controllers/BookController.php';;
class LoginController {
    private $bookController;
    private $userModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->userModel = new UserModel($db);
        $this->bookController = new BookController($db);
    }

    public function showLoginForm() {
        include 'views/auth/login.php';
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->authenticate($username, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['user_role'] = $user['id_rol_user'];
                $_SESSION['user_name'] = $user['name_user'];
                
                if ($user['id_rol_user'] == 1) {
                    header('Location: index.php?action=admin');
                } else {
                    header('Location: index.php?action=user');
                }
                exit();
            } else {
                $error = "Usuario o contraseña incorrectos";
                include 'views/auth/login.php';
            }
        }
    }

    public function showAdminDashboard() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 1) {
            header('Location: index.php?action=login');
            exit();
        }
        $bookCount = $this->bookController->countBook();
        $books = $this->bookController->informationBook();
        include 'views/admin/DasboardAdmin.php';
    }

    public function showUserDashboard() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 2) {
            header('Location: index.php?action=login');
            exit();
        }
        include 'views/user/dashboardUser.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
        exit();
    }
}