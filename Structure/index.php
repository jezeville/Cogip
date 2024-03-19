<?php
// require '../vendor/autoload.php';


// $router = new AltoRouter();

// $router->map('GET', '/', function() {
//     require __DIR__ . '/View/page/Home/homePage.php';
// });

// $router->map('GET', '/contact', function() {
//     require __DIR__ . '/View/page/Contact/contact.php';
// }, 'Contact');

// $match = $router->match();

// if ($match !== false) {
//     $target = $match['target'];
//     if (is_callable($target)) {
//         call_user_func_array($target, $match['params']);
//     } else {
//         require_once __DIR__ . "/View/page/{$target}.php";
//     }
// } else {
//     echo 'Error: Page not found';
// }






// $router->map('GET', '/contact', function() {
//     echo 'bien joué contact';
//     //require __DIR__ . '/View/page/Contact/contact.php';
// });

// $router->map('GET', '/invoice', function() {
//     echo 'bien joué invoice';
//     //require __DIR__ . '/View/page/Invoices/invoicePage.php';
// });

// $router->map('GET', '/companies', function() {
//     echo 'bien joué companies';
//     //require __DIR__ . '/View/page/Company/company.php';
// });

// $match = $router->match();

// var_dump($match);

// if ($match) {
//     echo 'test';
//     //require $match['target'];
// } else {
//     echo 'accueil';
//     // require __DIR__ . '/Core/connection.php';
//     // require __DIR__ . '/Model/companyModel.php';
//     // require __DIR__ . '/Model/invoiceModel.php';
//     // require __DIR__ . '/Model/contactModel.php';
//     // require __DIR__ . '/Controller/getHome.php';
//     // require __DIR__ . '/View/element/headerHome.php'; 
//     // require __DIR__ . '/View/page/Home/homePage.php';
//     // require __DIR__ . '/View/element/footer.php'; 
// }

    require __DIR__ . '/Core/connection.php';
    require __DIR__ . '/Model/companyModel.php';
    require __DIR__ . '/Model/invoiceModel.php';
    require __DIR__ . '/Model/contactModel.php';
    require __DIR__ . '/Model/deleteModel.php';
    require __DIR__ . '/Controller/delete.php';
    require __DIR__ . '/Controller/create.php';
    require __DIR__ . '/View/page/Dashboard/dashboard.php'; 

?>