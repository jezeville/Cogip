<?php

require '../Model/connection.php';


class ContactDetail{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function searchContact($searchValue)
    {
        $searchValue = '%' . $searchValue . '%';
        $sql = "SELECT contacts.*, companies.name AS company_name
        FROM contacts INNER JOIN companies ON contacts.company_id = companies.id 
        WHERE contacts.id LIKE :searchValue
        ORDER BY contacts.name ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':searchValue', $searchValue, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

}







?>