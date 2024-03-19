<?php
ob_start();



class delete
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function deleteFunction($tableName, $id)
    {
        try {
            $sql = "DELETE FROM $tableName WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();

            header('Location: index.php');
            exit();
            ob_end_flush();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}