<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <footer>

        <div class="flex p-12">
            <div class="flex flex-col w-full items-center">
                <div class="flex justify-center w-4/5 py-14 bg-white border-t-2 border-yellow-300">
                    <div class="flex items-center w-[95%]"> <!-- div conteneur de tout -->
                        <div class="w-1/2"> <!-- div cogip -->
                            <h2 class="text-5xl p-1 font-bold text-[#434138]">COGIP</h2>
                        </div>
                        <div class="w-1/2"> <!-- div conteneur informations sur la brand -->
                            <div class="flex items-center mb-4">
                                <img class="pr-[2%]" src="src/img/adresse.png">
                                <p class="text-[#0A142F] text-sm">345 Faulconer Drive, Suite 4 • Charlottesville, CA, 12345</p>
                            </div>
                            <div class="flex items-center mb-4"> <!-- div conteneur numéro de tel et du fax (à mettre en flex) -->
                                <div class="flex w-1/2"> <!-- téléphone -->
                                    <img class="pr-[4%]" src="src/img/phone.png">
                                    <p class="text-[#0A142F] text-sm">(123) 456-7890</p>
                                </div>

                                <div class="flex items-center w-1/2 mb-2"> <!-- fax -->
                                    <img class="pr-[4%]" src="src/img/fax.png">
                                    <p class="text-[#0A142F] text-sm">(123) 456-7890</p>
                                </div>
                            </div>

                            <div class="flex items-center"> <!-- social medias -->
                                <p class="pr-[3%] text-sm text-[#0A142F]">Social Media</p>
                                <img class="pr-[3%]" src="src/img/twitter.png">
                                <img class="pr-[3%]" src="src/img/facebook.png">
                                <img class="pr-[3%]" src="src/img/linkedin.png">
                                <img class="pr-[3%]" src="src/img/youtube.png">
                                <img class="pr-[3%]" src="src/img/instagram.png">
                                <img class="pr-[3%]" src="src/img/google.png">
                                <img class="pr-[3%]" src="src/img/pinterest.png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex w-4/5 border-t-[1px] border-[#7BB9FC]"> <!-- conteneur navbar + copyright -->
                    <div class="flex w-4/5 uppercase mt-[1%]"> <!-- navbar -->
                        <div class="text-[#0A142F] text-sm mr-[5%]">Home</div>
                        <div class="text-[#0A142F] text-sm mr-[5%]">Invoices</div>
                        <div class="text-[#0A142F] text-sm mr-[5%]">Companies</div>
                        <div class="text-[#0A142F] text-sm mr-[5%]">Contact</div>
                        <div class="text-[#0A142F] text-sm mr-[5%]">Privacy Policy</div>
                    </div>
                    <div class="mt-[1%] ml-[5%]">
                        <p class="text-[#0A142F]">Copyright 2024 - Cogip Inc.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
