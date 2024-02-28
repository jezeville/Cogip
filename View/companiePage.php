
<?php

require '../Controller/getCompagnie.php';
require 'header.php';
require 'footer.php';
$companie = new companie($db);
$companies = $companie->getAllCompanies();

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Companies</title>
    </head>
    <body>
        <main>
            <h1>All companies</h1>
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search company name">
            </form>
            <table>
                <tr>
                    <th>Name</th>
                    <th>TVA</th>
                    <th>Country</th>
                    <th>Type</th>
                    <th>Created at</th>
                </tr>
                <?php
                if(isset($_GET['nbr'])){
                    $cpt = $_GET['nbr'];
                    $page = $_GET['nbr'];
                } else {
                    $cpt = 0; 
                    $page = 0;
                }
                $limit = $cpt + 10;
                $limit_tab = count($companies);

                $filteredCompanies = $companies;
                if(isset($_GET['search']) && !empty($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $filteredCompanies = array_filter($companies, function($company) use ($searchTerm) {
                        return stripos($company['name'], $searchTerm) !== false;
                    });
                    $limit_tab = count($filteredCompanies); 
                }

                foreach(array_slice($filteredCompanies, $cpt, 10) as $company) {
                ?>
                    <tr>
                        <td><a href="company_details.php?id=<?php echo $company['id']; ?>"><?php echo $company['name']; ?></a></td>
                        <td><?php echo $company['tva']; ?></td>
                        <td><?php echo $company['country']; ?></td>
                        <td><?php echo $company['type_name']; ?></td>
                        <td><?php echo substr($company['created_at'], 0, 10); ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
            <?php
            if ($page != 0 ){
                $before = $page-10;
                $after = $page+10;
            }
            else{
                $before = $page;
                $after = $page+10; 
            }
            if($page < count($companies)-(10 + substr(count($companies),1, 2))){
                $first = $page;
                $first_number = round(($page/10)+1);
                $second = $page+10;
                $second_number = round(($page/10)+2);
            }
            else{
                $first = $page-10;
                $first_number = round(($page/10));
                $second = $page;
                $second_number = round(($page/10)+1);
            }
            
            $before_last = count($companies)-(substr(count($companies),1, 2)+10);
            $before_last_number = round((count($companies)/10)-1);
            $last = count($companies)-substr(count($companies),1, 2);
            $last_number = round((count($companies)/10));

            echo '<a href="companiePage.php?nbr='.$before.'"><</a>';
            echo '<a href="companiePage.php?nbr='.$first.'">'.$first_number.'</a>';
            echo '<a href="companiePage.php?nbr='.$second.'">'.$second_number.'</a>';
            echo '<a href="companiePage.php?nbr='.$first.'">...</a>';
            echo '<a href="companiePage.php?nbr='.$before_last.'">'.$before_last_number.'</a>';
            echo '<a href="companiePage.php?nbr='.$last.'">'.$last_number.'</a>';
            echo '<a href="companiePage.php?nbr='.$after.'">></a>';
            ?>
        </main>
    </body>
</html>


