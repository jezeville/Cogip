

<?php
    
        $Company = new Company($db);
        $contact = new Contact($db);
        $invoice = new Invoices($db);
        $limit = 5;
        $latestCompanies = $Company->getLatestCompanies($limit);
        $latestInvoices = $invoice->getLatestInvoices($limit);
        $latestContacts = $contact->getLatestContact($limit);
    ?>

