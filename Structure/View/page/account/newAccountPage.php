
<?php 
    require '../../../Controller/getAccount.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a new account</title>
</head>
<body >
        <h2 class="font-display font-bold text-3xl  mx-auto text-gray-700 text-center" style="text-align: center;">Create a new account</h2>

    <div class="w-screen h-screen flex flex-col justify-center items-center lg:grid lg:grid-cols-2">

            <img src="..\..\src\img\unlock.svg" class="lg-block mx-60 w-60 hover:scale-150 transition-all duration-500 transform max-auto " />
            
            <form class="flex flex-col justify-center " method="post" action="newAccountPage.php">
                
                <div class="relative mt-8">
                    <i class="fa fa-user absolute text-yellow-400 text-xl"></i>
                    <input type="text" name="registration_first_name" placeholder="first_name" class="pl-8 border-b-2 font-display focus:outline-none focus:border-yellow-400 capitalize transition-all duration-500 text-lg" required>
                </div>
                <div class="relative mt-8">
                    <i class="fa fa-user absolute text-yellow-400 text-xl"></i>
                    <input type="text" name="registration_last_name" placeholder="last_name" class="pl-8 border-b-2 font-display focus:outline-none focus:border-yellow-400 capitalize transition-all duration-500 text-lg" required>
                </div>
                <div class="relative mt-8">
                    <i class="fa fa-envelope absolute text-yellow-400 text-xl"></i>
                    <input type="email" name="registration_email" placeholder="email" class="pl-8 border-b-2 font-display focus:outline-none focus:border-yellow-400 transition-all duration-500 text-lg" required>
                </div>
                <div class="relative mt-8">
                    <i class="fa fa-lock absolute text-yellow-400 text-xl"></i>
                    <input type="password" name="registration_password" id="password" placeholder="password" class="pl-8 border-b-2 font-display focus:outline-none focus:border-yellow-400 capitalize transition-all duration-500 text-lg" required>
                </div>
                <div class="relative mt-8">
                    <i class="fa fa-lock absolute text-yellow-400 text-xl"></i>
                <input type="password" name="confirm_password" id="password" placeholder="Confirm password" class="pl-8 border-b-2 font-display focus:outline-none focus:border-yellow-400 capitalize transition-all duration-500 text-lg" required>
                </div>
                <button type="submit" name="valider" class="mt-8 w-32 py-2 px-4 bg-yellow-400 rounded-full text-white font-bold uppercase text-sm lg:text-lg mt-4 transform hover:translate-y-1 transition-all duration-500">Create</button>
                <p class="mt-4 text-gray-600 font-bold">Already a user? <a href="login.php" class="mt-4 text-yellow-400 font-bold hover:text-yellow-600 focus:border-yellow-400 transition-all duration-500 ">Login</a></p>
            </form>
    </div>
</body>
</html>
