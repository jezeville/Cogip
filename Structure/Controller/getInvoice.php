
  <?php

        require '../../../Model/invoiceModel.php';

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
