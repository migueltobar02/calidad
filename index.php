<?php
session_start();
require_once 'config/Db_conect.php';
require_once 'controllers/LoginController.php';
require_once 'controllers/BookController.php';
require_once 'controllers/DelectController.php';
require_once 'controllers/InsertController.php';
require_once 'controllers/UpdateController.php';
// Manejar las solicitudes de archivos CSS
if (preg_match('/\.css$/', $_SERVER["REQUEST_URI"])) {
    header("Content-Type: text/css");
    readfile($_SERVER["DOCUMENT_ROOT"] . $_SERVER["REQUEST_URI"]);
    exit;
}

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

$loginController = new LoginController();
$bookController = new BookController();
$delectController = new DelectController();
$InsertController = new InsertController();
$UpdateController = new UpdateController();

switch ($action) {
    case 'user':
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $books = $query ? $bookController->searchBooks($query) : $bookController->informationBook();
        $readBooks = $bookController->readBook();
        include 'views/users/dashboardUser.php';
        break;
    case 'login':
        $loginController->showLoginForm();
        break;
    case 'authenticate':
        $loginController->authenticate();
        break;
    case 'admin':
        $loginController->showAdminDashboard();
        break;
    case 'user':
        $loginController->showUserDashboard();
        break;
    case 'logout':
        $loginController->logout();
        break;

    case 'confirmationdeleteBook':
        if (isset($_GET['id'])) {
            $delectController->deleteBook($_GET['id']);
        } 
        break;
    case 'insertBook':
        $InsertController->insertBook();
        break;
    case 'handleRequest':
        $bookController->handleRequest();
        break;
    case 'UpdateBook':
            $UpdateController->updateBook();
        break;
    default:
        $loginController->showLoginForm();
}