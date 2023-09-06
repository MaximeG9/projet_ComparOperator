<?php
$bdd = "mysql:host=172.16.238.12;dbname=tp_operator";
$user = "root";
$password = "";

try {
    $bdd = new PDO ($bdd,$user,$password);
} catch (Exception $message) {
    echo "il y a un souci <br>" . "<pre>$message</pre>";
}
