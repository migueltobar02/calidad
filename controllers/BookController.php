<?php
require_once 'models/BookModel.php';

class BookController {
    private $bookModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->bookModel = new BookModel($db);
    }

    public function countBook() {
        return $this->bookModel->countBook();
    }

    public function informationBook() {
        return $this->bookModel->informationBook();
    }

    public function updateBook() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_producto = $_POST['id'];
            $nombre = $_POST['InputNombre'];
            $descripcion = $_POST['Inputdescripcion'];
            $imagen = $_FILES['Inputimagen']['name'];
            $precio = $_POST['InputPrecio'];
            $cantidad = $_POST['InputCantidad'];
            $lenguaje = $_POST['InputLenguaje'];
            $Tipo = $_POST['InputTipo'];
            $Genero = $_POST['InputGenero'];
            $Autor = $_POST['InputAutor'];
            $fecha = $_POST['fecha'];
            $valor = $_POST['valor'];
    
            $ruta = "assets/img/" . $imagen;
            $inputimagenguardadaa = $_POST['inputimagenguardada'];
    
            if ($ruta === 'assets/img/') {
                $ruta = $inputimagenguardadaa;
            } elseif ($inputimagenguardadaa === $ruta) {
                $ruta = $inputimagenguardadaa; 
            } else {
                move_uploaded_file($_FILES['Inputimagen']['tmp_name'], $ruta);
            }
    
            // Llama al modelo para actualizar el libro
            return $this->bookModel->updateBook($id_producto, $nombre, $ruta, $precio, $cantidad, $descripcion, $fecha, $Genero, $Tipo, $Autor, $lenguaje);
        }
    }

}