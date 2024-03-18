
<?php
    require '../../../Model/contactModel.php';

$ContactDisplay = new Contact($db);

// pagination paramétrage
$maxPage = 10;
$defaultPage = 1;
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : $defaultPage;
$offset = ($currentPage - 1) * $maxPage;

// formulaire
if(isset($_POST['inputContact'])){
    $searchValue = trim($_POST['inputContact']);
    $result = $ContactDisplay->searchContact($searchValue);
} else {
    $result = $ContactDisplay->getContactPagination($maxPage, $offset);
}

