
<?php

require('../Controller/getInvoice.php');



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
<div class="items-center m-auto w-4/5">
<div class="relative mt-14">
    <span class="absolute bottom-1 left-14 w-1/5 h-4 bg-yellow-400"></span>
    <span class="text-5xl font-extrabold text-black relative inline-block">
        <h2>All invoices</h2>
    </span>
</div>
<!-- formulaire HTML -->
    <div class="flex justify-end ">
    <form method="POST" action="" class="rounded-md border-gray-400 border-2 p-2">
        <input type="text" name="inputInvoices" placeholder="Search company" >
    </form>
    </div>
<!-- tableau HTML -->
    
    <table class="w-full mt-14 ">
    <tr class="bg-yellow-400 w-full h-11">
        <th class="text-left pl-8 w-1/6">Invoice number</th>
        <th class="text-left pl-8 w-1/6">Due dates</th>
        <th class="text-left pl-8 w-1/4">Company</th>
        <th class="text-left pl-8">Created at</th>
    </tr>


    <?php
        $rowColor = "bg-gray-200";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) :
            $rowColor = $rowColor === "bg-gray-200" ? "bg-white" : "bg-gray-200";
        ?>
            <tr class="<?php echo $rowColor; ?> hover:bg-blue-200 h-11">
            

                <td class="text-left pl-8 w-1/6 font-bold">
                    <a href="companyDetailPage.php?id=<?php echo $row['company_id']; ?>"><?php echo $row['ref']; ?></a></td>
                <td class="text-left pl-8 w-1/6 font-bold"><?php echo $row['due_date']?></td>
                <td class="text-left pl-8 w-1/4 font-bold"><?php echo $row['company_name']?></td>
                <td class="text-left pl-8 font-bold"><?php echo $row['created_date']?></td>
            </tr>
        <?php endwhile; ?> 
        </table>
   <?php
 // pagination comptage
 $totalRecords = $invoicesDisplay->getInvoicesCount();
 $totalPages = ceil($totalRecords / $maxPage);

 echo '<div class="flex justify-center my-14 ">';

 // pagination précédent
 if ($currentPage > 1) {
     $previousPage = $currentPage - 1;
     echo "<a href='invoicePage.php?page=$previousPage' class='border-gray-400 border-2 h-6 w-6 flex items-center justify-center mr-1'><</a>";
    }
 
 // paginaton ellipse
 $ellipsis = false;

 for ($i = 1; $i <= $totalPages; $i++) {
     if ($i == 1 || $i == $totalPages || abs($i - $currentPage) <= 2) {
         echo "<a href='invoicePage.php?page=$i' class='border-gray-400 border-2 h-6 w-6 flex items-center justify-center mx-1'>$i</a> ";
         $ellipsis = false;
     } elseif (!$ellipsis) {
         echo "... ";
         $ellipsis = true;
     }
 }

 // pagination suivant
 if ($currentPage < $totalPages) {
     $nextPage = $currentPage + 1;
     echo "<a href='invoicePage.php?page=$nextPage' class='border-gray-400 border-2 h-6 w-6 flex items-center justify-center ml-1'>></a>";
 }

 echo "</div>";
?>
</div>
</main>
<?php require ('footer.php');?>
</body>
</html>
