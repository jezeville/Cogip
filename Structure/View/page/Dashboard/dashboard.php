
<!DOCTYPE html>
<html lang="en">

<?php 
require('../../..//Model/companyModel.php');
require('../../../Model/contactModel.php');
require('../../../Model/invoiceModel.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>

<body>


    <div class="flex"> <!-- conteneur de la colonne et la page -->
        <div class="relative w-[15%] flex flex-col"><!-- conteneur de la colonne latérale -->
            <div class="mt-14">
                <img class="mx-auto rounded-full mb-[10%]" src="../../src/img/avatar_dashboard.svg" alt="Profile image">
                <p class="text-center font-bold text-2xl">Henry<br> George</p>
            </div>
            <div class=""> <!-- div visuelle de séparation -->
                <img src="../../src/img/Separation.png" class="mt-[15%] -ml-1 mb-[5%] pointer-events-none select-none">
            </div>
            <div class="flex flex-col mt-[15%] ml-[15%]"> <!-- conteneur du menu -->
                <div class="mb-[10%] flex flex-row"> <!-- conteneur de l'icone et du lien de menu -->
                    <img class="mr-[10%]" src="../../src/img/Icon_dashboard.png">
                    <a href="">Dashboard</a>
                </div>
                <div class="mb-[10%] flex flex-row"> <!-- conteneur de l'icone et du lien de menu -->
                    <img class="mr-[10%]" src="../../src/img/Icon_Invoices.png">
                    <a href="">Invoices</a>
                </div>
                <div class="mb-[10%] flex flex-row"> <!-- conteneur de l'icone et du lien de menu -->
                    <img class="mr-[10%]" src="../../src/img/Icon_companies.png">
                    <a href="">Companies</a>
                </div>
                <div class="mb-[10%] flex flex-row"> <!-- conteneur de l'icone et du lien de menu -->
                    <img class="mr-[10%]" src="../../src/img/Icon_contact.png"> <a href="">Contact</a>
                </div>
            </div>
            <div class="w-full absolute bottom-0 left-0 mb-2"> <!-- conteneur du log out -->
                <img class="" src="../../src/img/separation.png">
                <div class="mt-2 flex ml-4 mr-4 justify-center items-center">
                    <img src="../../src/img/avatar_dashboard.svg" class="w-10 w-1/6">
                    <div class="w-5/6 text-right text-[#9698D6] text-sm hover:text-[#7578D2] ease-in-out duration-300">
                        <a href="#logout">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-[#F5F5FB] w-[85%]"> <!-- conteneur de la page -->
            <div class="m-[4%] relative"> <!-- conteneur header -->
                <div class="mb-[4%]">
                    <h2 class="text-2xl font-black">Dashboard</h2>
                    <p class="text-sm">dashboard/</p>
                </div>
                <div class="bg-[#9698D6] rounded-lg text-white flex"> <!-- conteneur de la box "welcome back" -->
                    <div class="p-20">
                        <h2 class="text-4xl font-bold mb-2">Welcome back Henry!</H2>
                        <p>You can here add an invoice, a company <br> and some contacts</p>
                    </div>
                    <img class="absolute -top-14 right-32 h-full pointer-events-none select-none min-[320px]:hidden lg:block"
                        src="../../src/img/illustration_dashboard.svg">
                </div>
            </div>
            <!-- factures -->
            <div class="grid grid-cols-2 m-[4%] gap-10"> <!-- div conteneur des différentes box -->
                <?php
                $invoices = (new Invoices($db))->getInvoicesDashboard();
                ?>
                <div class="bg-white rounded-lg p-[5%] shadow-md">
                    <h2 class="font-bold text-xl">Last invoices</h2>
                    <img class="mt-2 mb-4 pointer-events-none select-none" src="src/img/separator.svg">
                    <table class="" border='1'>
                        <tr class="">
                            <th class="text-left">Invoice number</th>
                            <th class="text-left">Date</th>
                            <th class="text-left">Company</th>
                            <th class="text-left">Action</th>
                        </tr>
                        <?php foreach ($invoices as $row): ?>
                            <tr class="edit-mode text-sm" id="invoice_<?php echo $row['id']; ?>">
                                <td>
                                    <div class="mb-2 mt-2">
                                        <a href="#"
                                            onclick="toggleEdit('invoice_<?php echo $row['id']; ?>', 'ref', <?php echo $row['id']; ?>)">
                                            <span class="mr-6" data-field="ref">
                                                <?php echo $row['ref']; ?>
                                            </span>
                                        </a>
                                    </div>
                                </td>

                    <td>
                        <form method="POST" action="/Cogip/Structure/dashboard">
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
                                <td>
                                    <a href="#"
                                        onclick="toggleEdit('invoice_<?php echo $row['id']; ?>', 'created_date', <?php echo $row['id']; ?>)">
                                        <div class="mb-2 mt-2">
                                            <span class="editable whitespace-nowrap text-left mr-6"
                                                data-field="created_date">
                                                <?php echo $row['created_date']; ?>
                                            </span>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="#"
                                        onclick="toggleEdit('invoice_<?php echo $row['id']; ?>', 'company_name', <?php echo $row['id']; ?>)">
                                        <div class="">
                                            <span class="editable whitespace-nowrap text-left mr-6"
                                                data-field="company_name">
                                                <?php echo $row['company_name']; ?>
                                            </span>
                                        </div>
                                    </a>

                                </td>
                                <td>
                                    <form method="POST" action="dashboard.php">
                                        <input type="hidden" name="delete_invoice" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_button"
                                            class="text-[#9698D6] font-bold hover:text-[#7578D2] ease-in-out duration-300">Delete</button>
                                    </form>
                                </td>
                    </div>
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
            <div class="bg-white rounded-lg p-[5%] shadow-md">
                <h2 class="font-bold text-xl">Last companies</h2>
                <img class="mt-2 mb-4 pointer-events-none select-none" src="src/img/separator.svg">
                <table class="mb-[5%]" border='1'>
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-left">TVA</th>
                        <th class="text-left">Country</th>
                    </tr>

            <?php foreach ($company as $row) : ?>
                <tr>
                    <td><a href='edit_company.php?ref=<?php echo $row['name']; ?>'><?php echo $row['name']; ?></a></td>
                    <td><?php echo $row['tva']; ?></td>
                    <td><?php echo $row['country']; ?></a></td>
                    <td>
                        <form method="POST" action="dashboard">
                            <input type="hidden" name="delete_company" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_button_company">Delete</button>
                        </form>

                    </td>
                    <td>
                        <button class="updateButton" onclick="update(this, <?php echo $row['id']; ?>)" value="<?php echo $row['id']; ?>">Update</button>
                    </td>
                    <?php foreach ($company as $row): ?>
                        <tr class="text-sm">
                            <td>
                                <a href='edit_company.php?ref=<?php echo $row['name']; ?>'>
                                    <div class="mb-2 mt-2 mr-6">
                                        <?php echo $row['name']; ?>
                                </a>
                </div>
                </td>
                <td>
                    <div class="mb-2 mt-2 mr-6">
                        <?php echo $row['tva']; ?>
                    </div>
                </td>

                <td>
                    <div class="mb-2 mt-2 mr-6">
                        <?php echo $row['country']; ?></a>
                    </div>
                </td>

                <td>
                    <form method="POST" action="dashboard.php">
                        <input type="hidden" name="delete_company" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete_button"
                            class="text-[#9698D6] font-bold hover:text-[#7578D2] ease-in-out duration-300">Delete</button>
                    </form>
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
                        <form method="POST" action="dashboard">
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
        <!-- contact -->
        <?php
        $contact = (new Contact($db))->getContactDashboard();
        if (isset($_POST['delete_contact'])) {
            $deleteContact = (new Contact($db))->deleteFunction('contacts', $_POST['delete_contact']);
        } ?>
        <div class="bg-white rounded-lg p-[5%] shadow-md">
            <h2 class="font-bold text-xl">Last contacts</h2>
            <img class="mt-2 mb-4 pointer-events-none select-none" src="src/img/separator.svg">
            <table class="mb-[5%]" border='1'>
                <tr>
                    <th class="text-left">Name</th>
                    <th class="text-left">Phone</th>
                    <th class="text-left">Email</th>
                </tr>

                <?php foreach ($contact as $row): ?>
                    <tr class="text-sm">
                        <td>
                            <div class="mb-2 mt-2 mr-6">
                                <a href='edit_contact.php?ref=<?php echo $row['name']; ?>'>
                                    <?php echo $row['name']; ?>
                                </a>
                            </div>
                        </td>
                        <td>
                            <div class="mb-2 mt-2 mr-6">
                                <?php echo $row['phone']; ?>
                            </div>
                        </td>
                        <td>
                            <div class="mb-2 mt-2 mr-6">
                                <?php echo $row['email']; ?></a>
                            </div>
                        </td>
                        <td>
                            <form method="POST" action="dashboard.php">
                                <input type="hidden" name="delete_contact" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_button"
                                    class="text-[#9698D6] font-bold hover:text-[#7578D2] ease-in-out duration-300">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
    </div>
</body>



</html>