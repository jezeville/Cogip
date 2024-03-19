<?php


// dashboard delete invoices
$invoices = (new Invoices($db))->getInvoicesDashboard();

if (isset($_POST['delete_button_invoices'])) {
    $deleteInvoices = (new delete($db))->deleteFunction('invoices', $_POST['delete_invoices']);
}

// dashboard delete coompany
$company = (new Company($db))->getCompanyDashboard();
if (isset($_POST['delete_button_company'])) {
    $deleteCompany = (new delete($db))->deleteFunction('companies', $_POST['delete_company']);
}

// dashboard delete contact
$contact = (new Contact($db))->getContactDashboard();
if (isset($_POST['delete_button_contact'])) {
    $deleteContact = (new delete($db))->deleteFunction('contacts', $_POST['delete_contact']);
}

?>