<?php

// Récupérer le chemin de l'URL depuis la chaîne de requête

$path = substr((parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)),16);

// Définir les routes avec les actions associées
$routes = [
    '/' => 'accueil',
    '/contact' => 'contact',
    '/companie' => 'companie',
    '/invoice' => 'invoice',
    '/sign' => 'sign',
    '/login' => 'login',
    '/dashboard' => 'dashboard',
];

// Vérifier si le chemin demandé correspond à une route
$action = $routes[$path] ?? null;

// Si aucune route correspondante n'est trouvée, rediriger vers une page d'erreur 404
if (!$action) {
    header("HTTP/1.0 404 Not Found");
    echo "Erreur 404 - Page non trouvée";
    exit;
}
else {
    require __DIR__ . '/Core/connection.php';
    require __DIR__ . '/Model/companyModel.php';
    require __DIR__ . '/Model/invoiceModel.php';
    require __DIR__ . '/Model/contactModel.php';


    switch ($action) {
        case 'accueil':
            require __DIR__ . '/Controller/getHome.php';
            require __DIR__ . '/View/element/headerHome.php';
            require __DIR__ . '/View/page/Home/homePage.php';
            require __DIR__ . '/View/element/footer.php'; 
            break;
        case 'contact':
            require __DIR__ .'/Controller/getContact.php';
            require __DIR__ .'/View/element/header.php' ;
            require __DIR__ . '/View/page/Contact/contact.php';
            require __DIR__ .'/View/element/footer.php' ;
            break;
        case 'companie':
            require __DIR__ .'/Controller/getCompany.php';
            require __DIR__ .'/View/element/header.php' ;
            require __DIR__ . '/View/page/Company/company.php';
            require __DIR__ .'/View/element/footer.php' ;
            break;
        case 'invoice':
            require __DIR__ .'/Controller/getInvoice.php';
            require __DIR__ .'/View/element/header.php' ;
            require __DIR__ . '/View/page/Invoices/invoicePage.php';
            require __DIR__ .'/View/element/footer.php' ;
            break;    
        
        case 'sign':
            require __DIR__ . '/Model/accountModel.php';
            require __DIR__ . '/Controller/getAccount.php';
            require __DIR__ . '/View/page/account/newAccountPage.php';
            break;    
        
        case 'login':
            require __DIR__ . '/Model/authModel.php';
            require __DIR__ . '/Controller/auth.php';
            require __DIR__ . '/View/page/account/login.php';
            break;    
    
        case 'dashboard':
            require __DIR__ . '/Model/deleteModel.php';
            require __DIR__ . '/Controller/delete.php';
            require __DIR__ . '/Controller/create.php';
            require __DIR__ . '/View/page/Dashboard/dashboard.php'; 
        }
}

    

?>