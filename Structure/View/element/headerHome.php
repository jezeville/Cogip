<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header class="bg-yellow-300">
        <div class="flex justify-center items-center pt-20 pb-8">

            <div class="w-4/6 flex md:max-xl:w-5/6"> <!-- Conteneur du brand name et de la nav bar -->
                <div class="">
                    <a class="text-5xl font-bold md:ml-18" href="renvoie la page d'acceuil">COGIP</a>
                </div>

                <nav class="ml-24 flex items-center"> <!-- élément de la navbar -->
                    <ul class="list-none flex space-x-4 md:max-xl:space-x-0">
                        <li class="text-xl font-bold border-none hover:border-solid border-2 border-black px-2 py-2 active:border-solid border-2"><a href="/Cogip/Structure/">Home</a></li>
                        <li class="text-xl font-bold border-none hover:border-solid border-2 border-black px-2 py-2 active:border-solid border-2"><a href="/Cogip/Structure/contact">Contact</a></li>
                        <li class="text-xl font-bold border-none hover:border-solid border-2 border-black px-2 py-2 active:border-solid border-2"><a href="/Cogip/Structure/invoice">Invoice</a></li>
                        <li class="text-xl font-bold border-none hover:border-solid border-2 border-black px-2 py-2 active:border-solid border-2"><a href="/Cogip/Structure/companie">Companies</a></li>
                    </ul>
                </nav>
            </div>

            <div class="w-1/6 flex items-center space-x-8 md:max-xl:space-x-2 md:max-xl:w-3/6"> <!-- Conteneur de la navbar login/signup -->
                <button class="text-xl bg-white font-bold ease-in-out duration-300 rounded-lg px-5 py-3 hover:bg-yellow-400 rounded-lg px-5 py-3 focus:ring-4 focus:outline-none focus:ring-white dark:hover:bg-white dark:focus:ring-white">Sign Up</button>
                <button class="text-xl font-bold ease-in-out duration-300 hover:bg-white rounded-lg px-5 py-3 focus:ring-4 focus:outline-none focus:ring-white dark:hover:bg-white ">Login</button>
            </div>
        </div>
        <div class="flex w-full items-center justify-center bg-yellow-300"> <!-- conteneur du hero -->
            <div class="w-2/6 uppercase text-6xl font-black">Manage your customers and invoices easily</div> <!-- texte du hero -->
            <div class="w-2/6 pointer-events-none select-none"><img src="View/src/img/hero.png"></div> <!-- image du hero -->
        </div>

        <div class="ml-24 mt-8 hidden md:block"> <!-- SVG décoratif de la bannière -->
            <svg width="1299" height="112" viewBox="0 0 1299 112" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 39.3514H649.5L1046 0L1299 112H0V39.3514Z" fill="white" />
            </svg>
        </div>
    </header>
