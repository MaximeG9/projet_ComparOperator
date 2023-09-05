<?php
$bdd = "mysql:host=localhost;dbname=tp_operator";
$user = "root";
$password = "";

try {
    $bdd = new PDO ($bdd,$user,$password);
} catch (Exception $message) {
    echo "il y a un souci <br>" . "<pre>$message</pre>";
}