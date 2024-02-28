
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
                }
                else{
                    $cpt = 0; 
                    $page = 0;
                }
                $limit = $cpt+10;
                $limit_tab = count($companies);
                while ($cpt < $limit && $cpt < $limit_tab) {
                ?>
                    <tr>
                        <td><a href="company_details.php?id=<?php echo $companies[$cpt]['id']; ?>"><?php echo $companies[$cpt]['name']; ?></a></td>
                        <td><?php echo $companies[$cpt]['tva']; ?></td>
                        <td><?php echo $companies[$cpt]['country']; ?></td>
                        <td><?php echo $companies[$cpt]['type_name']; ?></td>
                        <td><?php echo substr($companies[$cpt]['created_at'], 0, 10); ?></td>
                    </tr>
                <?php
                $cpt++; 
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


