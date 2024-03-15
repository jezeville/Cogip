
<?php
     require '../../../Model/companyModel.php';
     require '../../../Model/invoiceModel.php';
     require '../../../Model/contactModel.php';

    $Company = new Company($db);
    $contact = new Contact($db);
    $invoice = new Invoices($db);
    $idCompany = trim($_GET['id']);
    $result = $Company->searchCompanyByID($idCompany);
    $result2 = $invoice->searchInvoicesByID($idCompany);
    $result3 = $contact->searchContactByID($idCompany);
?>
