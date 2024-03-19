
<?php

class Account
    {
        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function processRegistration()
        {
            {
                // Récupérer les données du formulaire
                $registration_first_name = isset($_POST["registration_first_name"]) ? $_POST["registration_first_name"] : "";
                $registration_last_name = isset($_POST["registration_last_name"]) ? $_POST["registration_last_name"] : "";
                $registration_password = isset($_POST["registration_password"]) ? $_POST["registration_password"] : "";
                $confirm_password = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : "";
                $registration_email = isset($_POST["registration_email"]) ? $_POST["registration_email"] : "";
        
                // Validation des champs 
               // echo "valider";
                if (empty($registration_first_name) || empty($registration_last_name) || empty($registration_password) || empty($confirm_password) || empty($registration_email) ) {
        
                    $errorMessage = "Tous les champs sont obligatoires.";
                    
                    return;
                }

                //validation de password

                if ($registration_password !== $confirm_password) {
                    
                    $errorMessage = "Les mots de passe ne correspondent pas.";
                    
                    return;
                }
        
         echo "Registration data received:<br>";
            var_dump($_POST);
                // Hasher le mot de passe
               $hashed_password = password_hash($registration_password, PASSWORD_DEFAULT);
        
                // c pr créer une requête SQL d'insertion pour ajouter le nouvel utilisateur à la table users
                $stmt = $this->db->prepare("INSERT INTO users (first_name, last_name, role_id, email, password) VALUES (?, ?, 1, ?, ?)");
        $stmt->bindParam(1, $registration_first_name);
        $stmt->bindParam(2, $registration_last_name);
        $stmt->bindParam(3, $registration_email);
        $stmt->bindParam(4, $hashed_password);

                echo "Executing SQL Query:<br>";
                var_dump($stmt);
                // exécuter la requête
                if ($stmt->execute()) {
                    // Redirection vers la page de connexion ou affichage d'un message de succès
                   header("Location: login.php?registration_success=true");
                    exit();
                } else {
                    // Gestion des erreurs, par exemple :
                     echo "Erreur lors de l'inscription : " . implode(", ", $stmt->errorInfo());
                }
            }
        }
    }

