<?php
require('../Model/connection.php');

class Authentification
{
    private $db;
    private $errorMessage;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function processLogin()
    {

        $first_nameErr = $last_nameErr = $passwordErr = "";
         
        $errorMessage = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            $first_name = isset($_POST["first_name"]) ? $_POST["first_name"] : "";
            $last_name = isset($_POST["last_name"]) ? $_POST["last_name"] : "";
            $password = isset($_POST["password"]) ? $_POST["password"] : "";

            if (empty($first_name)) {
                $first_nameErr = "Prénom requis";
            }

            if (empty($last_name)) {
                $last_nameErr = "Nom de famille requis";
            }

            if (empty($password)) {
                $passwordErr = "Mot de passe requis";
            }

            if (empty($first_nameErr) && empty($last_nameErr) && empty($passwordErr)) {
                $stmt = $this->db->prepare("SELECT id, first_name, last_name, password FROM users WHERE first_name = ?");
                $stmt->bindParam(1, $first_name);

                if ($stmt->execute()) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($row && password_verify($password, $row["password"])) {
                        $_SESSION["user_id"] = $row["id"];
                         
                    $errorMessage = "Connexion réussie !";
                       
                        header("Location: homePage.php");
                        exit();
                    } else {
                        $this->errorMessage = "Prénom, nom de famille ou mot de passe incorrect";
                    }
                } else {
                    
                    error_log("Database error: " . implode(", ", $stmt->errorInfo()));
                }
            }
        }
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}
?>
