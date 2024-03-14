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

    if (isset($_POST['delete_invoices'])) {
        $deleteInvoices = (new Invoices($db))->deleteFunction('invoices', $_POST['delete_invoices']);
    }

    if (isset($_POST['save_button'])) {
        echo "Save button clicked!";

        // Utilisez l'ID envoyé depuis la requête AJAX
        $id = isset($_POST['id']) ? $_POST['id'] : null;

        if ($id !== null && isset($_POST['ref']) && isset($_POST['created_at']) && isset($_POST['company_name'])) {
            $value1 = $_POST['ref'];
            $value2 = $_POST['created_at'];
            $value3 = $_POST['company_name'];

            echo "ID: $id, Value1: $value1, Value2: $value2, Value3: $value3";

            $update = (new management($db))->updateFunction([$value1, $value2, $value3,], $id);

            try {
                if ($update) {
                    echo "Mise à jour réussie côté client.";
                } else {
                    echo "Erreur lors de la mise à jour côté client.";
                }
            } catch (PDOException $e) {
                echo "Erreur SQL : " . $e->getMessage();
            }
        }
    }



    ?>

    <!-- Invoices -->
    <div>
        <h2>Last invoices</h2>
        <table border='1'>
            <tr>
                <th>Invoice number</th>
                <th>Date</th>
                <th>Company</th>
                <th>Delete</th>
                <th>Update</th>
                <th>Save</th>
            </tr>

            <?php foreach ($invoices as $row) : ?>
                <tr>
                    <td><a href='edit_invoices.php?ref=<?php echo $row['ref']; ?>'><?php echo $row['ref']; ?></a></td>

                    <td>
                        <?php echo $row['created_date']; ?>
                    </td>
                    <td>
                        <?php echo $row['company_name']; ?>
                    </td>


                    <td>
                        <form method="POST" action="dashboard.php">
                            <input type="hidden" name="delete_invoices" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_button">Delete</button>
                        </form>
                    </td>


                    <td>
                        <button class="updateButton" onclick="enableEditing(this, '<?php echo $row['ref']; ?>')">Update</button>
                    </td>



                    <td>
                        <button class="saveButton" onclick="saveChanges(this)" style="display:none;" data-id="<?php echo $row['id']; ?>" data-ref="<?php echo $row['ref']; ?>" data-created_at="<?php echo $row['created_date']; ?>" data-company_name="<?php echo $row['company_name']; ?>">Save</button>


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
                    <td>
                        <button class="updateButton" onclick="update(this, <?php echo $row['id']; ?>)" value="<?php echo $row['id']; ?>">Update</button>
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
                    <td>
                        <button class="updateButton" onclick="update(this, <?php echo $row['id']; ?>)" value="<?php echo $row['id']; ?>">Update</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>


    <script src="src/invoicesUpdate.js"></script>
    <script src="src/companyUpdate.js"></script>
    <script src="src/contactsUpdate.js"></script>

</body>



</html>