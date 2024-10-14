<?php
require_once 'models/BookModel.php';

class BookController {
    private $bookModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->bookModel = new BookModel($db);
    }

    public function searchBooks($query) {
        return $this->bookModel->searchBooks($query);
    }
    public function getUserId() {
        // Retorna el ID del usuario desde la sesión
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }

    public function countBook() {
        return $this->bookModel->countBook();
    }

    public function informationBook() {
        return $this->bookModel->informationBook();
    }

    public function generBook() {
        return $this->bookModel->generBook();
    }
    public function authorBook() {
        return $this->bookModel->authorBook();
    }
    public function lenguageBook() {
        return $this->bookModel->lenguageBook();
    }

    public function getBookById($id) {
        return $this->bookModel->getBookById($id);
    }
    public function handleRequest() {
        error_log("Inicio de handleRequest"); // Mensaje para logs
        
        try {
            // Asegúrate de que la solicitud es POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'handleRequest') {
                error_log("Datos POST recibidos: " . print_r($_POST, true));
    
                // Aquí puedes realizar la lógica para obtener los datos del libro usando el ID
                // Supongamos que usas $_POST['id'] para obtener el ID del libro
                $bookId = $_POST['id'] ?? 1; // Valor por defecto 1 si no se proporciona
                $bookData = $this->getBookById($bookId);
                error_log("Datos del libro obtenidos: " . print_r($bookData, true));
                // Simulación de obtener datos del libro
                $response = [
                    'success' => true,
                    'message' => 'Solicitud manejada correctamente',
                    'data' => $bookData // Usa los datos obtenidos
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                // Respuesta de prueba cuando no se cumple la condición
                error_log("Solicitud no válida o acción no encontrada");
                $response = [
                    'success' => false,
                    'message' => 'Método o acción no válida',
                    'data' => [
                        'id_book' => 0,
                        'name_book' => 'Sin datos',
                        'description_book' => 'Descripción no disponible',
                        'price_book' => 0.0,
                        'amount_book' => 0,
                        'year_book' => 'N/A',
                        'imagen_book' => 'ruta/de/imagen-no-disponible.jpg'
                    ]
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            }
            exit;
        } catch (Exception $e) {
            // Captura de cualquier excepción y enviar un error
            error_log("Error en handleRequest: " . $e->getMessage());
            $response = ['success' => false, 'message' => 'Error interno del servidor'];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        
        exit;
    }

    public function updateBook() {
        $id = $_POST['id'];
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
        $isUpdated =  $this->bookModel->updateBook($id, $bookName, $ruta, $price, $quantity, $description, $year, $gener, $author, $lenguage, $state, $rate);
          // Si la actualización fue exitosa, mostrar un mensaje de éxito
          if ($isUpdated) {
            // Almacenar un mensaje de éxito en la sesión
            $_SESSION['message'] = "El libro se ha actualizado correctamente.";
            $_SESSION['message_type'] = "success";  // Para estilos, puedes usar 'success', 'error', etc.
        } else {
            // Almacenar un mensaje de error en la sesión
            $_SESSION['message'] = "Error al actualizar el libro.";
            $_SESSION['message_type'] = "error";
        }
        
        // Redirigir al dashboard o a la misma página
        header("Location: index.php?action=admin");  // Cambia 'dashboard.php' por la ruta de tu página
        exit();
    }

    public function readBook() {
        $userId = $this->getUserId();
        if ($userId) {
            return  $readBooks = $this->bookModel->readBook($userId);
            
        }
        return null;
    }

}
