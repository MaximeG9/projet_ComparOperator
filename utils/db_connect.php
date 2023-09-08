<?php 
$user = 'root';
$password = '';

try {
    $bdd = new PDO('mysql:localhost=mysql;dbname=tp_operator', $user, $password);
} catch (PDOException $e) {
      print "Erreur ! : " . $e->getMessage() . "<br/>";
      die();
}