
<?php

require('../Controller/getReference.php');



$invoicesDisplay = new Invoices($db);

// pagination paramétrage
$maxPage = 10;
$defaultPage = 1;
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : $defaultPage;
$offset = ($currentPage - 1) * $maxPage;

// formulaire
if(isset($_POST['inputInvoices'])){
    $searchValue = trim($_POST['inputInvoices']);
    $result = $invoicesDisplay->searchInvoices($searchValue);
} else {
    $result = $invoicesDisplay->getInvoicesPagination($maxPage, $offset);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reference</title>
</head>
<body>
    <?php require('header.php'); ?>

<main>
<!-- formulaire HTML -->

    <form method="POST" action="">
        <input type="text" name="inputInvoices" placeholder="Search company" />
        <input type="submit" value="Search" />
    </form>

<!-- tableau HTML -->
    <h2>Dernières factures</h2>
    <table border='1'>
    <tr>
        <th>Numéro de facture</th>
        <th>Date d'échéance</th>
        <th>Entreprise</th>
        <th>Créé le</th>
    </tr>

    <?php  while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?php echo $row['ref']; ?></td>
                            <td><?php echo $row['due_date']?></td>
                            <td><?php echo $row['company_name']?></td>
                            <td><?php echo $row['created_date']?></td>
                        </tr>
                    <?php endwhile; ?> 
        </table>    
    <?php
   
 // pagination comptage
 $totalRecords = $invoicesDisplay->getInvoicesCount();
 $totalPages = ceil($totalRecords / $maxPage);

 echo "<div>";

 // pagination précédent
 if ($currentPage > 1) {
     $previousPage = $currentPage - 1;
     echo "<a href='pageReference.php?page=$previousPage'><</a> ";
 }
 
 // paginaton ellipse
 $ellipsis = false;

 for ($i = 1; $i <= $totalPages; $i++) {
     if ($i == 1 || $i == $totalPages || abs($i - $currentPage) <= 2) {
         echo "<a href='pageReference.php?page=$i'>$i</a> ";
         $ellipsis = false;
     } elseif (!$ellipsis) {
         echo "... ";
         $ellipsis = true;
     }
 }

 // pagination suivant
 if ($currentPage < $totalPages) {
     $nextPage = $currentPage + 1;
     echo "<a href='pageReference.php?page=$nextPage'>></a>";
 }

 echo "</div>";
?>
</main>
<?php require ('footer.php');?>
</body>
</html>
