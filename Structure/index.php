<?php
require '../vendor/autoload.php';

$router = new AltoRouter();

$router->map('GET', '/', function() {
    require __DIR__ . '/View/page/Home/homePage.php';
});

$router->map('GET', '/contact', function() {
    require __DIR__ . '/View/page/Contact/contact.php';
});

$match = $router->match();

if ($match === false) {
    require __DIR__ . '/Core/connection.php';
    require __DIR__ . '/Model/companyModel.php';
    require __DIR__ . '/Model/invoiceModel.php';
    require __DIR__ . '/Model/contactModel.php';
    require __DIR__ . '/Controller/getHome.php';
    require __DIR__ . '/View/element/headerHome.php'; 
    require __DIR__ . '/View/page/Home/homePage.php';
    require __DIR__ . '/View/element/footer.php'; 
} else {
    if ($match['target'] === 'contact') {
        require __DIR__ . '/View/page/Contact/contact.php';
    }
}
?>