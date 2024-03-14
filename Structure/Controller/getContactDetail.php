
<?php
    require '../../../Model/contactModel.php';
    $Contact = new Contact($db);
    $idContact = trim($_GET['id']);
    $result = $Contact->searchContactByID($idContact);
?>
