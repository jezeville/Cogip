<?php
    require '../../../Model/accountModel.php';

    $authen = new Account($db);
    $authen->processRegistration();

    if(isset($_POST["valider"])) {
        echo "Form submitted successfully.";
        var_dump($_POST);

    }

?>