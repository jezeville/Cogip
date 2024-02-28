<?php
// Inclusion du fichier de connexion à la base de données
require('../Model/connection.php');

// Définition de la classe Invoices
class Invoices
{
    // Propriété pour stocker la connexion à la base de données
    private $db;

    // Constructeur de la classe, prend la connexion à la base de données comme paramètre
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Méthode pour récupérer le nombre total de factures
    public function getInvoicesCount()
    {
        // Requête SQL pour compter le nombre total de factures
        $query = "SELECT COUNT(*) FROM invoices";
        // Exécution de la requête
        $stmt = $this->db->query($query);

        // Récupération du résultat
        return $stmt->fetchColumn();
    }

    // Méthode pour récupérer les données des factures de manière paginée
    public function getInvoicesPagination($maxPage, $offset)
    {
        // Requête SQL pour récupérer les données des factures avec pagination
        $sql = "SELECT invoices.ref, DATE(invoices.created_at) as created_date, DATE(invoices.updated_at) as updated_date, DATE(invoices.due_date) as due_date, companies.name AS company_name 
        FROM invoices
        JOIN companies ON invoices.id_company = companies.id
        JOIN types ON companies.type_id = types.id
        ORDER BY invoices.created_at DESC
        LIMIT :offset, :maxPage";

        // Préparation de la requête
        $stmt = $this->db->prepare($sql);
        // Liaison des paramètres
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':maxPage', $maxPage, PDO::PARAM_INT);
        // Exécution de la requête
        $stmt->execute();

        // Renvoi du résultat
        return $stmt;
    }

    // Méthode pour rechercher des factures en fonction d'une valeur de recherche
    public function searchInvoices($searchValue)
    {
        // Ajout de jokers SQL pour permettre une recherche partielle
        $searchValue = '%' . $searchValue . '%';
        // Requête SQL pour rechercher des factures en fonction du nom de l'entreprise
        $sql = "SELECT invoices.ref, DATE(invoices.created_at) as created_date, DATE(invoices.updated_at) as updated_date, DATE(invoices.due_date) as due_date, companies.name AS company_name 
            FROM invoices
            JOIN companies ON invoices.id_company = companies.id
            WHERE companies.name LIKE :searchValue
            ORDER BY invoices.created_at DESC";

        // Préparation de la requête
        $stmt = $this->db->prepare($sql);
        // Liaison des paramètres
        $stmt->bindParam(':searchValue', $searchValue, PDO::PARAM_STR);
        // Exécution de la requête
        $stmt->execute();

        // Renvoi du résultat
        return $stmt;
    }
}
?>
