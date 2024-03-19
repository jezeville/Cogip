<?php 



$authen = new Authentification($db);
$authen->processLogin();
                
 
$errorMessage = isset($authen) ? $authen->getErrorMessage() : '';