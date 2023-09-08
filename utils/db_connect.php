<?php 
$user = 'root';
$password = 'root';

try {
    $bdd = new PDO('mysql:host=mysql;dbname=tp_operator', $user, $password);
} catch (PDOException $e) {
      print "Erreur ! : " . $e->getMessage() . "<br/>";
      die();
}