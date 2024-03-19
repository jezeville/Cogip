<?php 
     require_once '../../../Controller/create.php';?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une facture</title>
</head>

<body>


<form action="" method="post">
    <input placeholder="Reference" type="text" id="ref" name="ref" required><br><br>
    <input placeholder="Price" type="number" id="price" name="price" required><br><br>
    <input placeholder="Company name" type="text" id="company_name" name="company_name" required><br><br>
    <input type="submit" name="save_invoice" value="Ajouter Facture">
</form>

</body>

</html>