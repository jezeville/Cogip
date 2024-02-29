<?php

require('../Controller/getInvoices.php');
require('header.php');


//$db = new ();
 $last_invoices = $db->getLatestInvoices(5);
 $last_contacts = $db->getLatestContact(5);
 $last_companies = $db->getLatestCompanies(5);

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cogip</title>
</head>

<body>
    <main>

<?php

    $invoices = getLatestInvoices($conn, 5);
    $people = getLatestContact($conn, 5);
    $companies = getLatestCompanies($conn, 5);
    
    // Affichage des données sur la page d'accueil
    ?>
    
    <section>
    <h2>Welcome, Jean-Christian Ranu!</h2>

    <!-- List of the 5 latest invoices -->
    <h3>The 5 latest invoices:</h3>
    <ul>
        <?php
        // Example of displaying invoices
        foreach ($invoices as $invoice) {
            echo "<li>{$invoice['invoices.ref']} - {$invoice['date']} - {$invoice['company']}</li>";
        }
        ?>
    </ul>

    <!-- List of the 5 latest entered people -->
    <h3>The 5 latest entered people:</h3>
    <ul>
        <?php
        
        foreach ($contacts as $contact) {
            echo "<li>{$ontact['name']} {$contact['last_name']} - {$person['email']}</li>";
        }
        ?>
    </ul>

    <!-- List of the 5 latest entered companies -->
    <h3>The 5 latest entered companies:</h3>
    <ul>
        <?php
        // Example of displaying companies
        foreach ($companies as $company) {
            echo "<li>{$company['name']} - {$company['type']}</li>";
        }
        ?>
    </ul>

    <!-- Link to the providers page -->
    <p><a href="providers.php">Go to the providers page</a></p>

    <!-- Link to the clients page -->
    <p><a href="clients.php">Go to the clients page</a></p>
</section>

<?php include('views/footer.php'); ?>