
<?php 
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

?>