<?php
ob_start();
require('../Model/connection.php');

class management
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

            header('Location: ../view/dashboard.php');
            exit();
            ob_end_flush();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateInvoice($id, $ref, $createdAt, $companyName)
    {
        $sql = "UPDATE invoices SET ref = :ref, created_at = :created_at, id_company = (SELECT id FROM companies WHERE name = :company_name) WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':ref', $ref, PDO::PARAM_STR);
        $stmt->bindParam(':created_at', $createdAt);
        $stmt->bindParam(':company_name', $companyName, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}


class Invoices extends management
{
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

class Contact extends management
{
    public function getContactDashboard()
    {
        $sql = "SELECT contacts.name, contacts.phone, contacts.email, contacts.id
        FROM contacts
        ORDER BY id DESC
        LIMIT 5";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createContact($name, $email, $phone)
    {


        $createdAt = date('Y-m-d H:i:s');

        $sqlContact = "INSERT INTO contacts (name, email, phone, created_at) VALUES (:name, :email, :phone, :created_at)";
        $stmtContact = $this->db->prepare($sqlContact);
        $stmtContact->bindParam(':name', $name, PDO::PARAM_STR);
        $stmtContact->bindParam(':email', $email);
        $stmtContact->bindParam(':phone', $phone);
        $stmtContact->bindParam(':created_at', $createdAt);

        $this->db->beginTransaction();
        try {
            $stmtContact->execute();
            $this->db->commit();
            header("location: ../view/dashboard.php");
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Erreur : " . $e->getMessage();
        }
    }
}
