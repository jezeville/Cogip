<?php
require '../../../Core/connection.php';


class Contact
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Méthode qui récupère le nombre total de factures
    public function getContactCount()
    {
        $query = "SELECT COUNT(*) FROM contacts";
        $stmt = $this->db->query($query);

        return $stmt->fetchColumn();
    }

    // Méthode pour récupérer les données des factures de manière paginée
    public function getContactPagination($maxPage, $offset)
    {
        $sql = "SELECT contacts.*, companies.name AS company_name 
        FROM contacts INNER JOIN companies ON contacts.company_id = companies.id ORDER BY contacts.name ASC 
        LIMIT :offset, :maxPage";


        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':maxPage', $maxPage, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    // Méthode pour rechercher des factures en fonction d'une valeur de recherche
    public function searchContact($searchValue)
    {
        $searchValue = '%' . $searchValue . '%';
        $sql = "SELECT contacts.*, companies.name AS company_name 
        FROM contacts INNER JOIN companies ON contacts.company_id = companies.id 
        WHERE contacts.name LIKE :searchValue
        ORDER BY contacts.name ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':searchValue', $searchValue, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public function searchContactByID($searchValue)
    {
        $searchValue = '%' . $searchValue . '%';
        $sql = "SELECT contacts.*, companies.name AS company_name
        FROM contacts INNER JOIN companies ON contacts.company_id = companies.id 
        WHERE companies.id LIKE :searchValue
        ORDER BY contacts.name ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':searchValue', $searchValue, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public function getLatestContact($limit) {
        $sql = "SELECT contacts.name, contacts.phone, contacts.email, companies.name AS company_name, DATE(contacts.created_at) as created_at 
        FROM contacts 
        JOIN companies ON contacts.company_id = companies.id
        ORDER BY created_at DESC LIMIT $limit";
        $result = $this->db->query($sql);

        return ($result->rowCount() > 0) ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}

?>