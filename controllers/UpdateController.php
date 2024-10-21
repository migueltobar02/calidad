<?php
require_once 'models/BookModel.php';

class UpdateController {
    private $bookModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->bookModel = new BookModel($db);
    }

    public function updateBook() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            $saveImagen = $_POST['inputimagenguardada'];
            $inputimagenguardadaa =  $_FILES['InputimagenUpdate']['name'];
            $ruta = "assets/img/" . $inputimagenguardadaa;

            if ($ruta === 'assets/img/') {
                $ruta=$saveImagen;
            } else if($saveImagen===$ruta) {
                $ruta=$saveImagen; 
            }else{
                $ruta = $ruta;
                move_uploaded_file($_FILES ['InputimagenUpdate']['tmp_name'],$ruta);
            }

            move_uploaded_file($_FILES['InputimagenUpdate']['tmp_name'], $ruta);
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
        exit;
        }
    }
    public function updateReadBook() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'updateReadStatus') {
                $idBook = $_POST['id'];
                $idUser = $_SESSION['user_id'];
                $isRead = $_POST['is_read']; // Obtener el valor si está leído o no
                date_default_timezone_set('America/Mexico_City');
                $DateBook = date('Y-m-d H:i:s');
    
                if ($isRead == 1) {
                    // Marcar como leído
                    $isUpdated = $this->bookModel->updateReadBook($idBook, $idUser, $DateBook);
                    if ($isUpdated) {
                        echo json_encode(['success' => true, 'message' => 'Libro marcado como leído']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al marcar como leído']);
                    }
                } else {
                    // Desmarcar como leído
                    $isUpdated = $this->bookModel->markUnreadBook($idBook);
                    if ($isUpdated) {
                        echo json_encode(['success' => true, 'message' => 'Libro desmarcado']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al desmarcar como leído']);
                    }
                }
                exit;
            }
        } catch (Exception $e) {
            error_log("Error en updateReadBook: " . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Se ha producido un error.']);
            exit;
        }
    }   



}           

?>  