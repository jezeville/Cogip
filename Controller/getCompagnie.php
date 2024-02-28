<?php

//Cette page affichera une liste de toutes les entreprises par ordre alphabétique. Le nom de l'entreprise fera l'objet d'un lien vers une nouvelle page détaillant l'entreprise, le contenu sera généré avec l'ID de l'entreprise choisie.

require '../Model/connection.php';

class companie{
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllCompanies() {
        $sql = "SELECT companies.*, types.name AS type_name FROM companies INNER JOIN types ON companies.type_id = types.id ORDER BY companies.name";
        $result = $this->conn->query($sql);

        $companies = [];
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $companies[] = $row;
            }
        }
        return $companies;
    }

    public function getCompanyByID($id) {
        $sql = "SELECT * FROM companies WHERE id = $id";
        $result = $this->conn->query($sql);

        if ($result->rowCount() == 1) {
            return $result->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

}
?>