<?php
require('../Model/connection.php'); ?>


<?php
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
        $sql = "SELECT invoices.ref, DATE(invoices.created_at) as created_date, DATE(invoices.updated_at) as updated_date, DATE(invoices.due_date) as due_date, companies.name AS company_name 
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

    public function createInvoice($db)
    {
        if (isset($_POST['reference']) && isset($_POST['company_name'])) {

            $reference = $_POST['reference'];
            $companyName = $_POST['company_name'];

            $insertQuery = "INSERT INTO cogip (ref, name) VALUES (:reference, :company_name)";

            $re = $db->prepare($insertQuery);
            $re->bindValue(':reference', $reference, PDO::PARAM_STR);
            $re->bindValue(':company_name', $companyName, PDO::PARAM_STR);

            if ($re->execute()) {
                header("location: ../View/dashboard.php");
                exit();
            } else {
                echo "Erreur lors de l'exécution de la requête";
            }
        } else {
            echo "Données POST manquantes";
        }
    }
}
