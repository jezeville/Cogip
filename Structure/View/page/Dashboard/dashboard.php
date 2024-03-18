<!DOCTYPE html>
<html lang="en">

<?php require('../../../Controller/getCompany.php'); ?>
<?php require('../../../Controller/getContact.php'); ?>
<?php require('../../../Controller/getInvoice.php'); ?>
<?php require('../../../Controller/delete.php'); ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>



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
                        <span class="editable" data-field="created_at" data-id="<?php echo $row['id']; ?>"><?php echo $row['created_date']; ?></span>
                    </td>
                    <td>
                        <span class="editable" data-field="company_name" data-id="<?php echo $row['id']; ?>"><?php echo $row['company_name']; ?></span>
                    </td>

                    <td>
                        <form method="POST" action="dashboard.php">
                            <input type="hidden" name="delete_invoices" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_button_invoices">Delete</button>
                        </form>

                    </td>

                    <td>
                        <button class="updateButton" onclick="enableEditing(this, '<?php echo $row['id']; ?>')">Update</button>
                    </td>

                    <td>
                        <button class="saveButton" onclick="saveChanges(this)" style="display:none;" data-id="<?php echo $row['id']; ?>">Save</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

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
                            <button type="submit" name="delete_button_company">Delete</button>
                        </form>

                    </td>
                    <td>
                        <button class="updateButton" onclick="update(this, <?php echo $row['id']; ?>)" value="<?php echo $row['id']; ?>">Update</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

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
                            <button type="submit" name="delete_button_contact">Delete</button>
                        </form>

                    </td>
                    <td>
                        <button class="updateButton" onclick="update(this, <?php echo $row['id']; ?>)" value="<?php echo $row['id']; ?>">Update</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>