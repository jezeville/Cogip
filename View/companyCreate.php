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

    if (isset($_POST['save_company'])) {
        $name = $_POST['name'];
        $country = $_POST['country'];
        $tva = $_POST['tva'];
    
        $company = new Company($db);
    
        if ($company->createCompany($name, $country, $tva)) {
            echo "Facture ajoutée avec succès.";
        } else {
            echo "Erreur lors de l'ajout de la facture.";
        }
    }
    ?>

<form action="" method="post">
    <input placeholder="name" type="text" id="name" name="name" required><br><br>
    <input placeholder="country" type="text" id="country" name="country" required><br><br>
    <input placeholder="tva" type="text" id="tva" name="tva" required><br><br>
    <input type="submit" name="save_company" value="Ajouter compagnie">
</form>

</body>

</html>
