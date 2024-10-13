<?php
class BookModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function searchBooks($query) {
        $query = "%$query%";
        $sql = "SELECT b.id_book, b.name_book, b.imagen_book, a.name_author 
                FROM books b 
                INNER JOIN authbooks ab ON b.id_book = ab.id_book_authbook 
                INNER JOIN authors a ON ab.id_author_authbook = a.id_author 
                WHERE b.name_book LIKE :query OR a.name_author LIKE :query 
                AND b.state_book = 2";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':query', $query, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    public function generBook() {
        $query = "SELECT * FROM geners";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function authorBook() {
        $query = "SELECT * FROM authors";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lenguageBook() {
        $query = "SELECT * FROM languages";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertBook($bookName, $imagen, $price, $quantity, $description, $year, $gener, $author, $lenguage , $state, $rate) {
        // Insertar libro
        $query = "INSERT INTO books (name_book, imagen_book, price_book, amount_book, description_book, year_book , state_book , rate_book)
                  VALUES (:bookName, :imagen, :price, :quantity, :description, :year ,  :state, :rate)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':bookName', $bookName);
        $stmt->bindParam(':imagen', $imagen);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':rate', $rate);
        if ($stmt->execute()) {
            $id_producto = $this->conn->lastInsertId();
            // Actualizar las tablas relacionadas
            $this->updateRelatedTablesInsert( $id_producto, $gener , $author, $lenguage);
            return true;
        }
        return false;
    }
    private function updateRelatedTablesInsert($id ,$Genero, $Autor, $lenguaje) {

        // Actualizar generos
        $query = "INSERT INTO generbooks (id_book_generbook, id_gener_generbook ) VALUES (:id_producto, :Genero)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id_producto', $id);
        $stmt->bindParam(':Genero', $Genero);
        $stmt->execute();   

        // Actualizar autores
        $query = "INSERT INTO authbooks (id_book_authbook , id_author_authbook) VALUES (:id_producto, :Autor)";
        $stmt = $this->conn->prepare($query);
       
        $stmt->bindParam(':id_producto', $id);
        $stmt->bindParam(':Autor', $Autor);
        
        $stmt->execute();

        // Actualizar lenguajes
        $query = "INSERT INTO lengbooks (id_book_lengbook, id_lenguage_lengbook) VALUES (:id_producto, :lenguage)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id_producto', $id);
        $stmt->bindParam(':lenguage', $lenguaje);
        $stmt->execute();
    }
    

    public function updateBook($id_producto, $nombre, $imagen, $precio, $cantidad, $descripcion, $fecha, $Genero, $Autor, $lenguaje) {
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

        echo"<script>alert('lenguaje: $lenguaje  antes de actualizar tablas ');</script>";
    
        if ($stmt->execute()) {
            // Actualizar las tablas relacionadas
            $this->updateRelatedTables($id_producto, $Genero, $Autor, $lenguaje);
            return true;
        }
        return false;
    }

    public function getBookById($id) {
        $query = "SELECT id_book, imagen_book, name_book, price_book, amount_book, description_book, year_book, name_author, name_lenguage, name_gener, id_lenguage , id_gener, id_author FROM books INNER JOIN authbooks ON books.id_book = authbooks.id_book_authbook INNER JOIN authors ON authbooks.id_author_authbook = authors.id_author INNER JOIN lengbooks ON books.id_book = lengbooks.id_book_lengbook INNER JOIN languages ON lengbooks.id_lenguage_lengbook = languages.id_lenguage INNER JOIN generbooks ON books.id_book = generbooks.id_book_generbook INNER JOIN geners ON generbooks.id_gener_generbook = geners.id_gener WHERE id_book = :id AND state_book = 2 LIMIT 1;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function updateRelatedTables($id_producto, $Genero,  $Autor, $lenguaje) {

        // Actualizar generos
        $query = "UPDATE generbooks SET id_gener_generbook = :Genero WHERE id_book_generbook = :id_producto";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Genero', $Genero);
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
    public function readBook($userId) {
        $query = "SELECT a.name_author, r.date_readbook, b.name_book, b.imagen_book FROM readbooks r JOIN authbooks ab ON r.id_book_readbook = ab.id_book_authbook JOIN authors a ON ab.id_author_authbook = a.id_author JOIN books b ON r.id_book_readbook = b.id_book WHERE r.id_user_readbook = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}