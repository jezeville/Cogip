<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header class="bg-[#F9DE4E]">
        <div class="flex items-center justify-center pt-20 pb-8">

            <div class="flex w-4/6"> <!-- Conteneur du brand name et de la nav bar -->
                <div class="">
                    <a class="text-5xl font-bold" href="renvoie la page d'acceuil">COGIP</a>
                </div>

                <nav class="flex items-center ml-24"> <!-- élément de la navbar -->
                    <ul class="flex space-x-4 list-none md:max-xl:space-x-0">
                        <li
                            class="px-2 py-2 text-xl font-bold border-2 border-black border-none hover:border-solid active:border-none">
                            <a href="#home">Home</a>
                        </li>
                        <li
                            class="px-2 py-2 text-xl font-bold border-2 border-black border-none hover:border-solid active:border-none">
                            <a href="#invoice">Invoice</a>
                        </li>
                        <li
                            class="px-2 py-2 text-xl font-bold border-2 border-black border-none hover:border-solid active:border-none">
                            <a href="#companies">Companies</a>
                        </li>
                        <li
                            class="px-2 py-2 text-xl font-bold border-2 border-black border-none hover:border-solid active:border-none">
                            <a href="#contact">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="flex items-center w-1/6 space-x-8 md:max-xl:space-x-2 md:max-xl:w-3/6">
                <!-- Conteneur de la navbar login/signup -->
                <button class="px-5 py-3 text-xl font-bold duration-300 ease-in-out bg-white rounded-lg">Sign
                    Up</button>
                <button
                    class="px-5 py-3 text-xl font-bold duration-300 ease-in-out rounded-lg hover:bg-yellow-200">Login</button>
            </div>
        </div>

        <div class="hidden mt-8 ml-24 md:block"> <!-- SVG décoratif de la bannière -->
            <svg width="1299" height="112" viewBox="0 0 1299 112" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 39.3514H649.5L1046 0L1299 112H0V39.3514Z" fill="white" />
            </svg>
        </div>
    </header>
</body>

</html>