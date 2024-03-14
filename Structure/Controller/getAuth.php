<?php
    require '../../../Model/authModel.php';

$authen = new Authentification($db);
$authen->processLogin();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $first_name = isset($_POST["first_name"]) ? $_POST["first_name"] : "";
    $last_name = isset($_POST["last_name"]) ? $_POST["last_name"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";


$errorMessage = isset($authen) ? $authen->getErrorMessage() : '';
}