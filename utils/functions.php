<?php

    function login() {
        
        include_once('../utils/db_connect.php');


$login = ["Le BeauGoss", "The Boss", "Le Clown"];       
$password = 'rootRoot';
password_hash($password, PASSWORD_DEFAULT);


if(!empty($_POST['login']) && !empty($_POST['password'])){
    if(password_verify($_POST['password'], $password) || in_array($_POST['login'], $login)){
        echo 'connexion success';
        $_SESSION['pseudo'] = $pseudo; // on enregistre le pseudo dans la session
        $_SESSION['password'] = $password; // on enregistre le mdp dans la session
        
    } else {
        echo 'login or password wrong';
    }
      } else {
        echo 'user don\'t exist';
    }
    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // si la requête est de type POST
    if(!empty($_POST['pseudo']) && !empty($_POST['mdp'])) { // si le pseudo est différent de vide
        session_start();
        $pseudo = $_POST['pseudo']; // on récupère le pseudo
        $mdp = $_POST['mdp']; // on récupère le mdp
    

        $query = "SELECT * FROM users WHERE pseudo = :pseudo AND mdp = SHA1(:mdp)"; // recherche de l'utilisateur
        $stmt = $db->prepare($query);
        $stmt->bindParam(':pseudo', $pseudo); // on remplace :pseudo par $pseudo
        $stmt->bindParam(':mdp', $mdp); // on remplace :mdp par $mdp
        var_dump($mdp);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);  // on récupère toutes les lignes de la table users
        var_dump($result);

        if (count($result) > 0) { // si l'utilisateur existe déjà
            $_SESSION['pseudo'] = $pseudo; // on enregistre le pseudo dans la session
            $_SESSION['mdp'] = $mdp; // on enregistre le mdp dans la session
            $_SESSION['id_user'] = $result['id_user']; // on enregistre l' id_user dans la session
            
            var_dump($_SESSION);
            header("Location: ../accueil.php");
        } else { // si l'utilisateur n'existe pas
            $query = "INSERT INTO users (pseudo, mdp) VALUES (:pseudo, SHA1(:mdp))"; // si l'utilisateur n'existe pas
            $stmt = $db->prepare($query);
            $stmt->bindParam(':pseudo', $pseudo); // on remplace :pseudo par $pseudo
            $stmt->bindParam(':mdp', $mdp); // on remplace :mdp par $mdp
            $stmt->execute();
            $_SESSION['pseudo'] = $pseudo; // on enregistre le pseudo dans la session
            $_SESSION['mdp'] = $mdp; // on enregistre le mdp dans la session
            $_SESSION['id_user'] = $id_user; // on enregistre l' id_user dans la session

            
            header("Location: ../accueil.php");
            exit();
        }
    } else { // si le pseudo est vide
        echo "Rentre un pseudo et un mot de pass putain tu fais chier là";
    }
}

?>
    