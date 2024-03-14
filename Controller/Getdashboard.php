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

    public function updateFunction($table, $id)
    {
        try {
            $sql = "UPDATE invoices
            INNER JOIN companies ON invoices.id_company = companies.id
            SET invoices.ref = :ref, invoices.created_at = :created_at, companies.name = :company_name
            WHERE invoices.id = :id";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':ref', $table[0]);
            $stmt->bindParam(':created_at', $table[1]);
            $stmt->bindParam(':company_name', $table[2]);
            $stmt->bindParam(':id', $id);  // Utilisez le paramètre distinct pour l'ID

            $stmt->execute();

            // Vérifiez si la mise à jour a réussi
            $rowCount = $stmt->rowCount();
            if ($rowCount > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            echo "<br>Query: " . $sql;
            return false;
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

    public function createInvoice($ref, $price, $name)
    {
        $sqlInvoice = "INSERT INTO invoices (ref, price) VALUES (:ref, :price)";
        $stmtInvoice = $this->db->prepare($sqlInvoice);
        $stmtInvoice->bindParam(':ref', $ref, PDO::PARAM_STR);
        $stmtInvoice->bindParam(':price', $price);

        $sqlCompanies = "INSERT INTO companies (name) VALUES (:name)";
        $stmtCompanies = $this->db->prepare($sqlCompanies);
        $stmtCompanies->bindParam(':name', $name);
    
        $this->db->beginTransaction(); // fonction native qui signifie : si une requete échoue, toutes les requetes échouent.
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
