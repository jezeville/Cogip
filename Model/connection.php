<?php

$servername = 'localhost';
$dbname = 'cogip';
$username = 'root';
$password = '';


try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "erreur : " . $e->getMessage();
}
?>


