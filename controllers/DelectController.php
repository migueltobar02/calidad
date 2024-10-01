<?php
require_once 'models/BookModel.php';

class DelectController {
    private $bookModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->bookModel = new BookModel($db);
    }

    public function confirmDelete() {
        if (isset($_GET['id'])) {
            $id_book = $_GET['id'];
            include 'views/book/confirmDelete.php';
        } else {
            // Manejar error: ID no proporcionado
            header('Location: index.php?action=admin&error=no_id');
        }
    }

    public function deleteBook() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id_book = $_POST['id'];
            $result = $this->bookModel->deleteBook($id_book);
            
            if ($result) {
                header('Location: index.php?action=admin&success=deleted');
            } else {
                header('Location: index.php?action=admin&error=delete_failed');
            }
        } else {
            // Manejar error: Solicitud inválida
            header('Location: index.php?action=admin&error=invalid_request');
        }
        exit;
    }

  
}