<?php 
$bdd = "mysql:host=localhost;dbname=tp_operator";
$user = 'root';
$pass = 'root';

try {
    $bdd = new PDO ($bdd, $user,$password);
} catch (PDOException $e) {
      print "Erreur ! : " . $e->getMessage() . "<br/>";
      die();
}

