<?php

require('../Controller/getInvoices.php');
require('header.php');


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

// formulaire HTML
echo '<form method="POST" action="">';
echo '<input type="text" name="inputInvoices" placeholder="Search company" />';
echo '<input type="submit" value="Search" />';
echo '</form>';

// tableau HTML
echo "<h2>Dernières factures</h2>";
echo "<table border='1'>";
echo "<tr><th>Numéro de facture</th><th>Date d'échéance</th><th>Entreprise</th><th>Créé le</th></tr>";

// données du tableau
if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['ref']}</td><td>{$row['due_date']}</td><td>{$row['company_name']}</td><td>{$row['created_date']}</td>";
        echo "</tr>";
    }

    echo "</table>";

    // pagination comptage
    $totalRecords = $invoicesDisplay->getInvoicesCount();
    $totalPages = ceil($totalRecords / $maxPage);

    echo "<div>";

    // pagination précédent
    if ($currentPage > 1) {
        $previousPage = $currentPage - 1;
        echo "<a href='invoicesPage.php?page=$previousPage'><</a> ";
    }

    // paginaton ellipse
    $ellipsis = false;

    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == 1 || $i == $totalPages || abs($i - $currentPage) <= 2) {
            echo "<a href='invoicesPage.php?page=$i'>$i</a> ";
            $ellipsis = false;
        } elseif (!$ellipsis) {
            echo "... ";
            $ellipsis = true;
        }
    }

    // pagination suivant
    if ($currentPage < $totalPages) {
        $nextPage = $currentPage + 1;
        echo "<a href='invoicesPage.php?page=$nextPage'>></a>";
    }

    echo "</div>";
} else {
    echo "Aucune facture trouvée.";
    echo "</table>";
}


require('footer.php');
?>
