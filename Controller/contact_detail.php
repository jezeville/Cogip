<?php

require '../Model/connection.php';

class Contact_detail {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getContactById($id) {
        if ($id !== null) {
            $sql = "SELECT * FROM contacts WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    
}
?>
