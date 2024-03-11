<?php require('../../Controller/getInvoices.php'); ?>
<?php require('../../Model/connection.php'); ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
$invoiceManager = new Invoices($db);
$invoiceManager->createInvoice($db);
?>

<form method="POST" action="">
    <h2>New invoice</h2>
    <input name="reference" placeholder="Reference"><br>
    <input name="company_name" placeholder="Company name">
    <input type="submit" value="Validate">
</form>


</body>
</html>
