
    <?php 
    require '../../../Controller/getCompanyDetail.php';
    require '../../element/header.php' ; ?>
    <main>
    <div class="items-center m-auto w-4/5">
        <!-- information sur l'entreprise -->
        <div class="relative mt-14">
            <span class="absolute bottom-0 left-14 w-1/5 h-6 bg-yellow-400"></span>
            <span class="text-5xl font-extrabold text-black relative inline-block">
            <?php $row = $result->fetch(PDO::FETCH_ASSOC)?>
                <h2 class="uppercase"><?php echo$row['name']?></h2>
            </span>
        </div>
        <div class="my-10">
            <p class="font-bold">Name: <?php echo $row['name']; ?></p>
            <p class="font-bold">TVA: <?php echo $row['tva']; ?></p>
            <p class="font-bold">Country: <?php echo $row['country']; ?></p>
            <p class="font-bold">Type: <?php echo $row['type_name']; ?></p>
        </div>
        <div class="h-1 bg-gray-200"></div>
        <!-- information sur les contacts -->
        <div class="relative my-14">
            <span class="text-5xl font-extrabold text-black relative inline-block">
                <h2>Contat people</h2>
            </span>
        </div>
        <div class="mb-14 flex flex-row">
                <?php if ($result3){ while ($row = $result3->fetch(PDO::FETCH_ASSOC)) :?>
                    <div class="flex flex-row justify-center w-1/6 bg-gray-100 rounded-2xl items-center p-3 drop-shadow-md">
                        <img src="../../src/img/icone.png" class="w-20 h-20 rounded-full">
                        <a href="contactDetail.php?id=<?php echo $row['id']?>" class="text-4xl font-extrabold text-center"><?php echo $row['name'];?></a>
                    </div>
                <?php endwhile; }?>
        </div>
        <div class="h-1 bg-gray-200"></div>
        <!-- informations sur les last invoices -->
        <div class="relative mt-14">
            <span class="text-5xl font-extrabold text-black relative inline-block">
                <h2>Last invoices</h2>
            </span>
        </div>
        <table class="w-full mt-14 ">
            <tr class="bg-yellow-400 w-full h-11">
                <th class="text-left pl-8 w-1/6">Invoice number</th>
                <th class="text-left pl-8 w-1/6">Dates</th>
                <th class="text-left pl-8 w-1/6">Company</th>
                <th class="text-left pl-8">Created at</th>
            </tr>
    <?php
        $rowColor = "bg-gray-200";
        while ($row = $result2->fetch(PDO::FETCH_ASSOC)) : $rowColor = $rowColor === "bg-gray-200" ? "bg-white" : "bg-gray-200";?>
            <tr class="<?php echo $rowColor; ?> hover:bg-blue-200 h-11">
                <td class="text-left pl-8 w-1/6 font-bold"><?php echo $row['ref']; ?></a></td>
                <td class="text-left pl-8 w-1/6 font-bold"><?php echo $row['due_date']?></td>
                <td class="text-left pl-8 w-1/6 font-bold"><?php echo $row['company_name']?></td>
                <td class="text-left pl-8 font-bold"><?php echo $row['created_at']?></td>
            </tr>
        <?php endwhile; ?> 
        </table>
    <div>    
    </main>
    <?php require '../../element/footer.php' ; ?>