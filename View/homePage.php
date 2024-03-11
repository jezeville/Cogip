<?php
require('../Controller/home.php');
require('header.php');

$home = new Home($db);
$limit = 5;
$latestInvoices = $home->getLatestInvoices($limit);
$latestContacts = $home->getLatestContact($limit);
$latestCompanies = $home->getLatestCompanies($limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cogip</title>
</head>

<body>
    <main class="items-center m-auto w-4/5">
        <section>
            <div class="relative mt-14">
                <span class="absolute bottom-1 left-14 w-1/5 h-4 "></span>
                <span class="text-2xl font-extrabold text-black relative inline-block">
                    <h4>Welcome, Jean-Christian Ranu!</h4>
                </span>
            </div>

            <!-- Table of the 5 latest invoices -->
            <h3 class="text-2xl font-extrabold text-black relative inline-block mt-10">Last invoices</h3>
            <table class="w-full mt-10">
                <tr class="bg-yellow-400 w-full h-11">
                    <th class="text-left pl-8 w-1/6">Invoice number</th>
                    <th class="text-left pl-8 w-1/6">Dates Due</th>
                    <th class="text-left pl-8 w-1/6">Company</th>
                    <th class="text-left pl-8 w-1/6">Created at</th>
                </tr>

                <?php
                $rowColor = "bg-gray-200";
                foreach ($latestInvoices as $invoice) :
                    $rowColor = $rowColor === "bg-gray-200" ? "bg-white" : "bg-gray-200";
                ?>
                    <tr class="<?= $rowColor ?> hover:bg-blue-200 h-11">
                        <td class="text-left pl-8 w-1/6 font-bold"><?= $invoice['ref']; ?></td>
                        <td class="text-left pl-8 w-1/6 font-bold"><?= $invoice['due_date']; ?></td>
                        <td class="text-left pl-8 w-1/6 font-bold"><?= $invoice['company_name']; ?></td>
                        <td class="text-left pl-8 w-1/6 font-bold"><?= $invoice['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <!-- Table of the 5 latest contacts -->
            <h3 class="text-2xl font-extrabold text-black relative inline-block mt-10">Last contacts</h3>
            <table class="w-full mt-14">
                <tr class="bg-yellow-400 w-full h-11">
                    <th class="text-left pl-8 w-1/6">Name</th>
                    <th class="text-left pl-8 w-1/6">Phone</th>
                    <th class="text-left pl-8 w-1/6">Mail</th>
                    <th class="text-left pl-8 w-1/6">Company</th>
                    <th class="text-left pl-8 w-1/6">Created at</th>
                </tr>

                <?php foreach ($latestContacts as $contact) : 
                $rowColor = $rowColor === "bg-gray-200" ? "bg-white" : "bg-gray-200";
                ?>
                    <tr class="<?= $rowColor ?> hover:bg-blue-200 h-11">
                        <td class="text-left pl-8 w-1/6 font-bold"><?= $contact['name']; ?></td>
                        <td class="text-left pl-8 w-1/6 font-bold"><?= $contact['phone']; ?></td>
                        <td class="text-left pl-8 w-1/6 font-bold"><?= $contact['email']; ?></td>
                        <td class="text-left pl-8 w-1/6 font-bold"><?= $contact['company_name']; ?></td>
                        <td class="text-left pl-8 w-1/6 font-bold"><?= $contact['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <!-- Table of the 5 latest companies -->
            <h3 class="text-2xl font-extrabold text-black relative inline-block mt-10">Last companies</h3>
            <table class="w-full mt-14">
                <tr class="bg-yellow-400 w-full h-11">
                    <th class="text-left pl-8 w-1/6">Name</th>
                    <th class="text-left pl-8 w-1/6">TVA</th>
                    <th class="text-left pl-8 w-1/6">Country</th>
                    <th class="text-left pl-8 w-1/6">Type</th>
                    <th class="text-left pl-8 w-1/6">Created at</th>
                </tr>

                <?php foreach ($latestCompanies as $company) : 
                    $rowColor = $rowColor === "bg-gray-200" ? "bg-white" : "bg-gray-200";
                    ?>
                    <tr class="<?= $rowColor ?> hover:bg-blue-200 h-11">
                        <td class="text-left pl-8 w-1/6 font-bold"><?= $company['name']; ?></td>
                        <td class="text-left pl-8 w-1/6 font-bold"><?= $company['TVA']; ?></td>
                        <td class="text-left pl-8 w-1/6 font-bold"><?= $company['country']; ?></td>
                        <td class="text-left pl-8 w-1/6 font-bold"><?= $company['type_name']; ?></td>
                        <td class="text-left pl-8 w-1/6 font-bold"><?= $company['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>

        <div class="mt-10">
    <p><a href="companyPage.php" class="block text-lg font-bold text-gray-600 hover:underline">Go to the providers page</a></p>
    <p><a href="contactPage.php" class="block text-lg font-bold text-gray-600 hover:underline">Go to the clients page</a></p>
</div>
    </main>
    <div class="flex justify-around items-center">
    <!-- Text on the left -->
    <div class="font-inter text-6xl font-extrabold leading-tight tracking-normal text-left">
        <p class="text-lg font-bold">WORK BETTER IN YOUR COMPANY</p>
    </div>

    <!-- Images on the right -->
    <div class="flex">
    <!-- Image 2 with reduced size -->
    <div class="relative">
        <img src="src/img/ph2.png" alt="Description of Image 2" class="w-97 h-auto">

        <!-- Image 1 inside Image 2 -->
        <div class="absolute inset-0 flex items-center justify-center">
            <img src="src/img/ph1.png" alt="Description of Image 1" class="w-110 h-auto mb-2">
        </div>
    </div>
</div>

</div>



    <?php require 'footer.php';?>
</body>

</html>
