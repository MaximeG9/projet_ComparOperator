<?php

function login()
{
    include_once('../utils/db_connect.php');


    $login = ["Maxime", "Jeremy", "Vincent"];
    $password = 'RootRoot';
    password_hash($password, PASSWORD_DEFAULT);


    if (!empty($_POST['login']) && !empty($_POST['password'])) {

        if (password_verify($_POST['password'], $password) || in_array($_POST['login'], $login)) {

            echo 'connexion success';

            $_SESSION['pseudo'] = $pseudo; // on enregistre le pseudo dans la session
            $_SESSION['password'] = $password; // on enregistre le mdp dans la session

            header('Location: /admin/dashboard.php');
        } else {
            echo 'login or password wrong';
        }
    }     
}


function getImage($destination) {
    global $bdd;
    $managerRepo = new ManagerRepository($bdd);
    $destinations = $managerRepo->getAllDestination();
    $destinationString = [];
    
    foreach ($destinations as $location){
        $destinationString[] = $location->getLocation();
    }
    if (in_array($destination, $destinationString)){
        // var_dump($destinationString);
        include_once('./partials/imgDestination.php');
    }
    
}


?>
    
