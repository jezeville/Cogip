<!DOCTYPE html>
<html lang="en">

<?php require('../Controller/Getdashboard.php'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>


    <div class="flex"> <!-- conteneur de la colonne et la page -->
        <div class="relative w-[15%] flex flex-col"><!-- conteneur de la colonne latérale -->
            <div class="mt-14">
                <img class="mx-auto rounded-full mb-[10%]" src="src/img/avatar_dashboard.svg" alt="Profile image">
                <p class="text-center font-bold text-2xl">Henry<br> George</p>
            </div>
            <div class=""> <!-- div visuelle de séparation -->
                <img src="src/img/Separation.png" class="mt-[15%] -ml-1 mb-[5%] pointer-events-none select-none">
            </div>
            <div class="flex flex-col mt-[15%] ml-[15%]"> <!-- conteneur du menu -->
                <div class="mb-[10%] flex flex-row"> <!-- conteneur de l'icone et du lien de menu -->
                    <img class="mr-[10%]" src="src/img/Icon_dashboard.png">
                    <a href="">Dashboard</a>
                </div>
                <div class="mb-[10%] flex flex-row"> <!-- conteneur de l'icone et du lien de menu -->
                    <img class="mr-[10%]" src="src/img/Icon_Invoices.png">
                    <a href="">Invoices</a>
                </div>
                <div class="mb-[10%] flex flex-row"> <!-- conteneur de l'icone et du lien de menu -->
                    <img class="mr-[10%]" src="src/img/Icon_companies.png">
                    <a href="">Companies</a>
                </div>
                <div class="mb-[10%] flex flex-row"> <!-- conteneur de l'icone et du lien de menu -->
                    <img class="mr-[10%]" src="src/img/Icon_contact.png"> <a href="">Contact</a>
                </div>
            </div>
            <div class="w-full absolute bottom-0 left-0 mb-2"> <!-- conteneur du log out -->
                <img class="" src="src/img/separation.png">
                <div class="mt-2 flex ml-4 mr-4 justify-center items-center">
                    <img src="src/img/avatar_dashboard.svg" class="w-10 w-1/6">
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
                    <img class="absolute -top-14 right-32 h-full pointer-events-none select-none"
                        src="src/img/illustration_dashboard.svg">
                </div>
            </div>

            <div class="m-[4%]">
                <div class="bg-white rounded-lg p-[3%] shadow-md">
                    <h2 class="font-bold text-xl border-b border-gray-200 pb-4">New Invoice</h2>
                    
                    <form action="" method="post" class="mt-6">
                        <label for="Reference" class="sr-only">Reference:</label>
                        <input type="text" id="Reference" name="ref" required placeholder="Reference"
                            class="p-2 w-full bg-gray-100 mb-4">
                        <br>
                        <label for="Price" class="sr-only">Price:</label>
                        <input type="text" id="Price" name="price" required placeholder="Price"
                            class="p-2 w-full bg-gray-100 mb-4">
                        <br>
                        <label for="CompanyName" class="sr-only">Company Name:</label>
                        <input type="text" id="CompanyName" name="company_name" required placeholder="Company Name"
                            class="p-2 w-full bg-gray-100 mb-4">
                        <button type="submit" name="save_invoice"
                            class="mt-1 bg-[#9698D6] text-white px-2 py-2 w-full text-left">Send</button>
                    </form>

                </div>
            </div>
</body>

</html>