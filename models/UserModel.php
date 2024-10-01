<?php
class UserModel {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function authenticate($username, $password) {
        $query = "SELECT id_user, name_user, password_user, id_rol_user FROM " . $this->table_name . " WHERE mail_user = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            echo "<script>console.log('Datos recibidos:', " . json_encode($row) . ");</script>";
            echo "<script>console.log('Datos que se envío: ', '" . htmlspecialchars($password, ENT_QUOTES) . "');</script>";
            echo "<script>console.log('Hash en la base de datos: ', '" . htmlspecialchars($row['password_user'], ENT_QUOTES) . "');</script>";


            // if (password_verify($password, $row['password_user'])) {
            //     echo "<script>console.log('Datos desde la funcion fue true');</script>";
            //     return $row;
            // }
            if ($password === $row['password_user']) {
                echo "<script>console.log('Datos desde la funcion fue true');</script>";
                return $row;
            }
            echo "<script>console.log('Datos desde la funcion fue false');</script>";
        }
        return false;
    }
}