<?php
require_once 'models/BookModel.php';

class InsertController {
    private $bookModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->bookModel = new BookModel($db);
    }

    public function insertBook() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bookName = $_POST['bookName'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $description = $_POST['description'];
            $year = $_POST['publicationDate'];
            $state = $_POST['state_book'];
            $rate = $_POST['rate_book'];
            $gener = $_POST['genreSelect'];
            $author = $_POST['authorSelect'];
            $lenguage = $_POST['lenguageSelect'];
            
            $inputimagenguardadaa =  $_FILES['Inputimagen']['name'];
            $ruta = "assets/img/" . $inputimagenguardadaa;

            move_uploaded_file($_FILES['Inputimagen']['tmp_name'], $ruta);
            // Llama al modelo para actualizar el libro
            $isInserted =  $this->bookModel->insertBook($bookName, $ruta, $price, $quantity, $description, $year, $gener, $author, $lenguage, $state, $rate);
              // Si la inserción fue exitosa, mostrar un mensaje de éxito
              if ($isInserted) {
                // Almacenar un mensaje de éxito en la sesión
                $_SESSION['message'] = "El libro se ha insertado correctamente.";
                $_SESSION['message_type'] = "success";  // Para estilos, puedes usar 'success', 'error', etc.
            } else {
                // Almacenar un mensaje de error en la sesión
                $_SESSION['message'] = "Error al insertar el libro.";
                $_SESSION['message_type'] = "error";
            }
            
            // Redirigir al dashboard o a la misma página
            header("Location: index.php?action=admin");  // Cambia 'dashboard.php' por la ruta de tu página
            exit();
        exit;
        }
    }
}           

?>