<!DOCTYPE html>
<html lang="en">

<?php require('../Controller/Getdashboard.php'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<!-- factures -->

<?php
    $invoices = (new Invoices($db))->getInvoicesDashboard();
    ?>
    <div>
        <h2>Last invoices</h2>
        <table border='1'>
            <tr>
                <th>Invoice number</th>
                <th>Date</th>
                <th>Company</th>
                <th>Action</th>
            </tr>
            <?php foreach ($invoices as $row) : ?>
                <tr class="edit-mode" id="invoice_<?php echo $row['id']; ?>">
                    <td>
                        <a href="#" onclick="toggleEdit('invoice_<?php echo $row['id']; ?>', 'ref', <?php echo $row['id']; ?>)">
                            <span class="editable" data-field="ref"><?php echo $row['ref']; ?></span>
                        </a>
                    </td>
                    <td>
                        <a href="#" onclick="toggleEdit('invoice_<?php echo $row['id']; ?>', 'created_date', <?php echo $row['id']; ?>)">
                            <span class="editable" data-field="created_date"><?php echo $row['created_date']; ?></span>
                        </a>
                    </td>
                    <td>
                        <a href="#" onclick="toggleEdit('invoice_<?php echo $row['id']; ?>', 'company_name', <?php echo $row['id']; ?>)">
                            <span class="editable" data-field="company_name"><?php echo $row['company_name']; ?></span>
                        </a>
                    </td>
                    <td>
                        <form method="POST" action="dashboard.php">
                            <input type="hidden" name="delete_invoice" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_button">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- company -->
<?php
    $company = (new Company($db))->getCompanyDashboard();
    if (isset($_POST['delete_company'])) {
        $deleteCompany = (new Company($db))->deleteFunction('companies', $_POST['delete_company']);
    } ?>
    <div>
        <h2>Last companies</h2>
        <table border='1'>
            <tr>
                <th>Name</th>
                <th>TVA</th>
                <th>Country</th>
            </tr>

            <?php foreach ($company as $row) : ?>
                <tr>
                    <td><a href='edit_company.php?ref=<?php echo $row['name']; ?>'><?php echo $row['name']; ?></a></td>
                    <td><?php echo $row['tva']; ?></td>
                    <td><?php echo $row['country']; ?></a></td>
                    <td>
                        <form method="POST" action="dashboard.php">
                            <input type="hidden" name="delete_company" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_button">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- contact -->
<?php
    $contact = (new Contact($db))->getContactDashboard();
    if (isset($_POST['delete_contact'])) {
        $deleteContact = (new Contact($db))->deleteFunction('contacts', $_POST['delete_contact']);
    } ?>
    <div>
        <h2>Last contacts</h2>
        <table border='1'>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>

            <?php foreach ($contact as $row) : ?>
                <tr>
                    <td><a href='edit_contact.php?ref=<?php echo $row['name']; ?>'><?php echo $row['name']; ?></a></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['email']; ?></a></td>
                    <td>
                        <form method="POST" action="dashboard.php">
                            <input type="hidden" name="delete_contact" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_button">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    
</body>



</html>