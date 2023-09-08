<?php
function login()
{
    include_once('../utils/db_connect.php');

    //var_dump($_SESSION);


    $login = ["Maxime", "Jeremy", "Vincent"];
    $password = password_hash('RootRoot', PASSWORD_DEFAULT);


    if (!empty($_POST['login']) && !empty($_POST['password'])) {

        if (password_verify($_POST['password'], $password) && in_array($_POST['login'], $login)) {
            session_start();

            //echo 'connexion success';

            $_SESSION['pseudo'] = $_POST['login']; // on enregistre le pseudo dans la session
            $_SESSION['password'] = $password; // on enregistre le mdp dans la session

            header('Location: /admin/dashboard.php');
        } else {
            //echo 'login or password wrong';
            header('Location: /admin/index.php?status=login or password wrong');
        }
    } else {
        header('Location: /admin/index.php?status=Empty form !');
    } 
}

function logout()
{
    //unset($_SESSION['pseudo']);
    //unset($_SESSION['password']);
    session_destroy();

    header('Location: /admin/index.php');
}

if (!isset($_POST['logout'])) {
    login();
} else {
    logout();
}

?>
