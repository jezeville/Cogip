<?php

require('../Model/connection.php');

class Home
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // function to get 5 last invoices
 // function to get 5 last invoices
public function getLatestInvoices($limit) {
    $sql = "SELECT invoices.ref, DATE(invoices.due_date) as due_date, companies.name AS company_name, DATE(invoices.created_at) as created_at  
        FROM invoices
        JOIN companies ON invoices.id_company = companies.id
        JOIN types ON companies.type_id = types.id
        ORDER BY invoices.created_at DESC LIMIT $limit";

    $result = $this->db->query($sql);

    return ($result->rowCount() > 0) ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
}


    // function to get 5 last contacts

    public function getLatestContact($limit) {
        $sql = "SELECT contacts.name, contacts.phone, contacts.email, companies.name AS company_name, DATE(contacts.created_at) as created_at 
        FROM contacts 
        JOIN companies ON contacts.company_id = companies.id
        ORDER BY created_at DESC LIMIT $limit";
        $result = $this->db->query($sql);

        return ($result->rowCount() > 0) ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    // function to get 5 last companies
    public function getLatestCompanies($limit) {
        $sql = "SELECT companies.name, companies.TVA, companies.country, types.name AS type_name,DATE(companies.created_at) AS created_at 
        FROM companies 
        JOIN types ON companies.type_id = types.id
        ORDER BY created_at DESC LIMIT $limit";
        $result = $this->db->query($sql);

        return ($result->rowCount() > 0) ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}
