<?php

require('../../../Model/invoiceModel.php');
require('../../../Model/companyModel.php');
require('../../../Model/contactModel.php');

// create invoices
if (isset($_POST['save_invoice'])) {
    $ref = $_POST['ref'];
    $price = $_POST['price'];
    $name = $_POST['company_name'];

    $invoices = new Invoices($db);

    if ($invoices->createInvoice($ref, $price, $name)) {
        echo "Facture ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de la facture.";
    }
}
// create contacts
if (isset($_POST['save_contact'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $contact = new Contact($db);

    if ($contact->createContact($name, $email, $phone)) {
        echo "Facture ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de la facture.";
    }
}

// create company
if (isset($_POST['save_company'])) {
    $name = $_POST['name'];
    $country = $_POST['country'];
    $tva = $_POST['tva'];

    $company = new Company($db);

    if ($company->createCompany($name, $country, $tva)) {
        echo "Facture ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de la facture.";
    }
}
