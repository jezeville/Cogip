<?php
require '../../../Core/connection.php';


class Invoices
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Méthode qui récupère le nombre total de factures
    public function getInvoicesCount()
    {
        $query = "SELECT COUNT(*) FROM invoices";
        $stmt = $this->db->query($query);

        return $stmt->fetchColumn();
    }

    // Méthode pour récupérer les données des factures de manière paginée
    public function getInvoicesPagination($maxPage, $offset)
    {
        $sql = "SELECT invoices.ref, DATE(invoices.created_at) as created_date, DATE(invoices.updated_at) as updated_date, DATE(invoices.due_date) as due_date, companies.name AS company_name, companies.id AS company_id
        FROM invoices
        JOIN companies ON invoices.id_company = companies.id
        JOIN types ON companies.type_id = types.id
        ORDER BY invoices.created_at DESC
        LIMIT :offset, :maxPage";


        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':maxPage', $maxPage, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    // Méthode pour rechercher des factures en fonction d'une valeur de recherche
    public function searchInvoices($searchValue)
    {
        $searchValue = '%' . $searchValue . '%';
        $sql = "SELECT invoices.ref, DATE(invoices.created_at) as created_date, DATE(invoices.updated_at) as updated_date, DATE(invoices.due_date) as due_date, companies.name AS company_name 
            FROM invoices
            JOIN companies ON invoices.id_company = companies.id
            WHERE companies.name LIKE :searchValue
            ORDER BY invoices.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':searchValue', $searchValue, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public function searchInvoicesByID($searchValue)
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

    public function getLatestInvoices($limit)
    {
        $sql = "SELECT invoices.ref, DATE(invoices.due_date) as due_date, companies.name AS company_name, DATE(invoices.created_at) as created_at  
            FROM invoices
            JOIN companies ON invoices.id_company = companies.id
            JOIN types ON companies.type_id = types.id
            ORDER BY invoices.created_at DESC LIMIT $limit";

        $result = $this->db->query($sql);

        return ($result->rowCount() > 0) ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function getInvoicesDashboard()
    {
        $sql = "SELECT invoices.ref, invoices.id, DATE(invoices.created_at) as created_date, companies.name AS company_name 
            FROM invoices
            JOIN companies ON invoices.id_company = companies.id
            JOIN types ON companies.type_id = types.id
            ORDER BY invoices.created_at DESC
            LIMIT 5";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createInvoice($ref, $price, $name)
    {


        $createdAt = date('Y-m-d H:i:s');
        $dueDate = date('Y-m-d', strtotime('+30 days'));

        $sqlInvoice = "INSERT INTO invoices (ref, price, created_at, due_date) VALUES (:ref, :price, :created_at, :due_date)";
        $stmtInvoice = $this->db->prepare($sqlInvoice);
        $stmtInvoice->bindParam(':ref', $ref, PDO::PARAM_STR);
        $stmtInvoice->bindParam(':price', $price);
        $stmtInvoice->bindParam(':created_at', $createdAt);
        $stmtInvoice->bindParam(':due_date', $dueDate);

        $sqlCompanies = "INSERT INTO companies (name) VALUES (:name)";
        $stmtCompanies = $this->db->prepare($sqlCompanies);
        $stmtCompanies->bindParam(':name', $name);

        $this->db->beginTransaction();
        try {
            $stmtInvoice->execute();
            $stmtCompanies->execute();
            $this->db->commit();
            header("location: ../view/dashboard.php");
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Erreur : " . $e->getMessage();
        }
    }
}
class Company extends management
{
    public function getCompanyDashboard()
    {
        $sql = "SELECT name, tva, country, id
        FROM companies
        ORDER BY id DESC
        LIMIT 5";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createCompany($name, $country, $tva)
    {


        $createdAt = date('Y-m-d H:i:s');

        $sqlCompany = "INSERT INTO companies (name, country, tva, created_at) VALUES (:name, :country, :tva, :created_at)";
        $stmtCompany = $this->db->prepare($sqlCompany);
        $stmtCompany->bindParam(':name', $name, PDO::PARAM_STR);
        $stmtCompany->bindParam(':country', $country);
        $stmtCompany->bindParam(':tva', $tva);
        $stmtCompany->bindParam(':created_at', $createdAt);

        $this->db->beginTransaction();
        try {
            $stmtCompany->execute();
            $this->db->commit();
            header("location: ../view/dashboard.php");
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Erreur : " . $e->getMessage();
        }
    }
}
