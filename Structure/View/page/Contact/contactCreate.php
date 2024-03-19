<?php 
     require_once '../../../Controller/create.php';?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>Create a Contact</title>
</head>

<body>

<form class="flex flex-col justify-center items-center" action="" method="post">
    <h2 class="my-8 font-display font-bold text-3xl text-gray-700 text-center">Create a New Contact</h2>

    <div class="relative mt-8">
        <i class="fa fa-user absolute text-yellow-400 text-xl"></i>
        <input placeholder="name" type="text" id="name" name="name" class="pl-8 border-b-2 font-display focus:outline-none focus:border-yellow-400 capitalize transition-all duration-500 text-lg" required>
    </div>
    <div class="relative mt-8">
        <i class="fa fa-envelope absolute text-yellow-400 text-xl"></i>
        <input placeholder="email" type="text" id="email" name="email" class="pl-8 border-b-2 font-display focus:outline-none focus:border-yellow-400 capitalize transition-all duration-500 text-lg" required>
    </div>
    <div class="relative mt-8">
        <i class="fa fa-phone absolute text-yellow-400 text-xl"></i>
        <input placeholder="phone" type="text" id="phone" name="phone" class="pl-8 border-b-2 font-display focus:outline-none focus:border-yellow-400 capitalize transition-all duration-500 text-lg" required>
    
    </div>
<button type="submit" name="save_contact" value="Ajouter contact" class="mt-8 w-48 py-3 px-6 bg-yellow-400 rounded-full text-white font-bold uppercase text-lg mt-4 transform hover:translate-y-1 transition-all duration-500"ranslate-y-1 transition-all duration-500">Add Contact</button>
</form>

</body>

</html>