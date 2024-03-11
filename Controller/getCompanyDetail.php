<?php
require '../Model/connection.php';


class CompanyDetail{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function searchCompany($searchValue)
    {
        $searchValue = '%' . $searchValue . '%';
        $sql = "SELECT companies.*, types.name AS type_name 
             FROM companies INNER JOIN types ON companies.type_id = types.id 
             WHERE companies.id LIKE :searchValue
             ORDER BY companies.name ASC ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':searchValue', $searchValue, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public function searchInvoices($searchValue)
    {
        $searchValue = '%' . $searchValue . '%';
        $sql = "SELECT invoices.*, companies.name AS company_name 
            FROM invoices
            JOIN companies ON invoices.id_company = companies.id
            WHERE companies.id LIKE :searchValue
            ORDER BY invoices.created_at DESC";


        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':searchValue', $searchValue, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }


    public function searchContact($searchValue)
    {
        $searchValue = '%' . $searchValue . '%';
        $sql = "SELECT contacts.*
        FROM contacts INNER JOIN companies ON contacts.company_id = companies.id 
        WHERE companies.id LIKE :searchValue
        ORDER BY contacts.name ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':searchValue', $searchValue, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

}


?>