<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une compagniee</title>
</head>

<body>

    <?php
    
    require_once '../Controller/Getdashboard.php';

    if (isset($_POST['save_contact'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
    
        $contact = new Contact($db);
    
        if ($contact->createContact($name, $email, $phone)) {
            echo "Facture ajoutée avec succès.";
        } else {
            echo "Erreur lors de l'ajout de la facture.";
        }
    }
    ?>

<form action="" method="post">
    <input placeholder="name" type="text" id="name" name="name" required><br><br>
    <input placeholder="email" type="text" id="email" name="email" required><br><br>
    <input placeholder="phone" type="number" id="phone" name="phone" required><br><br>
    <input type="submit" name="save_contact" value="Ajouter contact">
</form>

</body>

</html>
