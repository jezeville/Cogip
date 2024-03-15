<?php
require_once('../Controller/authentification.php');


$authen = new Authentification($db);
$authen->processLogin();


// pr récupérer les msg d'erreur de la classe Authentification
$errorMessage = isset($authen) ? $authen->getErrorMessage() : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

     <script src="https://cdn.tailwindcss.com"></script>
    <title>Login Page</title>
</head>
<body>
    
    <!-- pr affficher les msg d'erreur -->
    <?php if (isset($errorMessage)): ?>
        <p><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        
        <div class="w-screen h-screen flex flex-col justify-center items-center">
            <?php if (isset($_GET['registration_success']) && $_GET['registration_success'] === 'true'): ?>
                <p class="text-green-600 font-bold mb-8 text-lg">Successful registration ! Log in now.</p>
                <?php endif; ?>
                <!-- Formulaire de connexion -->
        <form class="flex flex-col justify-center items-center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <img src="src\img\avatar.svg" class="w-32" />
            <h2 class="my-8 font-display font-bold text-3xl text-gray-700 text-center">Welcome to Cogip</h2>
    <div class="relative">
        <i class="fa fa-user absolute text-yellow-400 text-xl"></i>
        <input type="text" name="first_name" placeholder="first_name" id="first_name" class="pl-8 border-b-2 font-display focus:outline-none focus:border-yellow-400 capitalize transition-all duration-500 text-lg" required>
        <span><?php echo isset($first_nameErr) ? $first_nameErr : ''; ?></span>
    </div>
    <div class="relative mt-8">
        <i class="fa fa-user absolute text-yellow-400 text-xl"></i>
        <input type="text" name="last_name" placeholder="last_name" id="last_name" class="pl-8 border-b-2 font-display focus:outline-none focus:border-yellow-400 transition-all duration-500 capitalize text-lg" required>
        <span><?php echo isset($last_nameErr) ? $last_nameErr : ''; ?></span>
    </div>
    <div class="relative mt-8">
        <i class="fa fa-lock absolute text-yellow-400 text-xl"></i>
        <input type="password" name="password" id="password" placeholder="password" class="pl-8 border-b-2 font-display focus:outline-none focus:border-yellow-400 capitalize transition-all duration-500 text-lg" required>
        <span><?php echo isset($passwordErr) ? $passwordErr : ''; ?></span>
    </div>
    <button type="submit" name="submit" class="mt-8 w-48 py-3 px-6 bg-yellow-400 rounded-full text-white font-bold uppercase text-lg mt-4 transform hover:translate-y-1 transition-all duration-500">login</button>
    <p class="mt-4 text-gray-600 font-bold">You don't have an account? <a href="newAccountPage.php" class="mt-4 text-yellow-400 font-bold hover:text-yellow-600 focus:border-yellow-400 transition-all duration-500 ">Create an account</a></p>
</form>
    </div>
</html>
