<?php
class BookModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function deleteBook($id_book) {
        // Utiliza un marcador de posición para el ID
        $query = "UPDATE books SET state_book = 1 WHERE books.id_book = :id_book";
        
        // Prepara la consulta
        $stmt = $this->conn->prepare($query);
        
        // Enlaza la variable $id_book al marcador de posición :id_book
        $stmt->bindParam(':id_book', $id_book, PDO::PARAM_INT);
        
        // Ejecuta la consulta y retorna true si tiene éxito
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    public function countBook() {
        $query = "SELECT COUNT(*) AS total FROM books WHERE books.state_book = 2";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function informationBook() {
        $query = "SELECT id_book, name_book, imagen_book FROM books WHERE books.state_book = 2";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateBook($id_producto, $nombre, $imagen, $precio, $cantidad, $descripcion, $fecha, $Genero, $Tipo, $Autor, $lenguaje) {
        // Actualizar el libro
        $query = "UPDATE books SET name_book = :nombre, imagen_book = :imagen, price_book = :precio, 
                  amount_book = :cantidad, description_book = :descripcion, year_book = :fecha 
                  WHERE id_book = :id_producto";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':imagen', $imagen);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':id_producto', $id_producto);
    
        if ($stmt->execute()) {
            // Actualizar las tablas relacionadas
            $this->updateRelatedTables($id_producto, $Genero, $Tipo, $Autor, $lenguaje);
            return true;
        }
        return false;
    }
    
    private function updateRelatedTables($id_producto, $Genero, $Tipo, $Autor, $lenguaje) {
        // Actualizar generos
        $query = "UPDATE generbooks SET id_gener_generbook = :Genero WHERE id_book_generbook = :id_producto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Genero', $Genero);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->execute();
    
        // Actualizar tipos
        $query = "UPDATE typesbooks SET id_type_typebook = :Tipo WHERE id_book_typebook = :id_producto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Tipo', $Tipo);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->execute();
    
        // Actualizar autores
        $query = "UPDATE authbooks SET id_author_authbook = :Autor WHERE id_book_authbook = :id_producto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Autor', $Autor);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->execute();
    
        // Actualizar lenguajes
        $query = "UPDATE lengbooks SET id_lenguage_lengbook = :lenguaje WHERE id_book_lengbook = :id_producto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':lenguaje', $lenguaje);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->execute();
    }

}