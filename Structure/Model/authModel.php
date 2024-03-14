<?php 

require '../../../Core/connection.php';

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
                $first_nameErr = "first name required";
            }

            if (empty($last_name)) {
                $last_nameErr = "last name required";
            }

            if (empty($password)) {
                $passwordErr = "password required";
            }

            if (empty($first_nameErr) && empty($last_nameErr) && empty($passwordErr)) {
                $stmt = $this->db->prepare("SELECT id, first_name, last_name, password FROM users WHERE first_name = ?");
                $stmt->bindParam(1, $first_name);

                if ($stmt->execute()) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($row && password_verify($password, $row["password"])) {
                        $_SESSION["user_id"] = $row["id"];
                         
                    $errorMessage = "Successful onnection !";
                       
                        header("Location: ../View/page/Home/homePage.php");
                        exit();
                    } else {
                        $this->errorMessage = "Incorrect first name, last name, or password";
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
