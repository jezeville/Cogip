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

            header('Location: ../Controller/dashboard.php');
            exit();
            ob_end_flush();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
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
}
