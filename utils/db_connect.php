<?php 
$user = 'root';
$pass = 'root';

try {
    $db = new PDO('mysql:host=mysql;dbname=tp_operator', $user, $pass);
} catch (PDOException $e) {
      print "Erreur ! : " . $e->getMessage() . "<br/>";
      die();
}