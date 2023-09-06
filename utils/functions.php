<?php

function login()
{
    include_once('../utils/db_connect.php');


    $login = ["Le BeauGoss", "The Boss", "Le Clown"];
    $password = 'rootRoot';
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


?>
    
