<?php 
$user = 'root';
$password = '';

try {
    $bdd = new PDO('mysql:host=localhost;dbname=tp_operator', $user, $password);
} catch (PDOException $e) {
      print "Erreur ! : " . $e->getMessage() . "<br/>";
      die();
}