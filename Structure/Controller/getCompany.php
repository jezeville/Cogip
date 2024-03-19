
<?php

$CompanyDisplay = new Company($db);

// pagination paramétrage
$maxPage = 10;
$defaultPage = 1;
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : $defaultPage;
$offset = ($currentPage - 1) * $maxPage;

// formulaire
if(isset($_POST['inputCompany'])){
    $searchValue = trim($_POST['inputCompany']);
    $result = $CompanyDisplay->searchCompany($searchValue);
} else {
    $result = $CompanyDisplay->getCompanyPagination($maxPage, $offset);
}

?>