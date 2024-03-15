
<?php 

require '../../../Core/connection.php';

class Company
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Méthode qui récupère le nombre total de factures
    public function getCompanyCount()
    {
        $query = "SELECT COUNT(*) FROM companies";
        $stmt = $this->db->query($query);

        return $stmt->fetchColumn();
    }

    // Méthode pour récupérer les données des factures de manière paginée
    public function getCompanyPagination($maxPage, $offset)
    {
        $sql = "SELECT companies.*, types.name AS type_name 
        FROM companies INNER JOIN types ON companies.type_id = types.id ORDER BY companies.name ASC 
        LIMIT :offset, :maxPage";


        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':maxPage', $maxPage, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    // Méthode pour rechercher des factures en fonction d'une valeur de recherche
    public function searchCompany($searchValue)
    {
        $searchValue = '%' . $searchValue . '%';
             $sql = "SELECT companies.*, types.name AS type_name 
             FROM companies INNER JOIN types ON companies.type_id = types.id 
             WHERE companies.name LIKE :searchValue
             ORDER BY companies.name ASC ";


        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':searchValue', $searchValue, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public function searchCompanyByID($searchValue)
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

    public function getLatestCompanies($limit) {
        $sql = "SELECT companies.name, companies.TVA, companies.country, types.name AS type_name,DATE(companies.created_at) AS created_at 
        FROM companies 
        JOIN types ON companies.type_id = types.id
        ORDER BY created_at DESC LIMIT $limit";
        $result = $this->db->query($sql);

        return ($result->rowCount() > 0) ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}

?>