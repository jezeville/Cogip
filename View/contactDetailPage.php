<?php
    require_once('../Controller/getContactDetail.php');
    $Contact = new ContactDetail($db);
    $idContact = trim($_GET['id']);
    $result = $Contact->searchContact($idContact);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>
    <?php require 'header.php'; ?>
    <main>
    <div class="items-center m-auto w-4/5 flex flex-row justify-items-center">

        <div class="relative mt-14 w-3/6">
            <span class="absolute bottom-0 left-14 w-1/2 h-6 bg-yellow-400"></span>
            <span class="text-5xl font-extrabold text-black relative inline-block">
            <?php $row = $result->fetch(PDO::FETCH_ASSOC)?>
                <h2 class="uppercase"><?php echo$row['name']?></h2>
            </span>

        </div>
        <img src="icone.png" class="w-80 h-80 rounded-full mt-12">


    </div>
    </main>
    <?php require 'footer.php'; ?>
</body>
</html>