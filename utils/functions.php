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

            $_SESSION['pseudo'] = $_POST['login']; // on enregistre le pseudo dans la session
            $_SESSION['password'] = $password; // on enregistre le mdp dans la session

            header('Location: /admin/dashboard.php');        

        } else {
            echo 'login or password wrong';
        }
    }     
}

function addTour():array
{
    if (count($_POST) > 0) {
        $result = [
            'status' => 'warning',
            'message' => 'Une erreur est survenue.'
        ];

        $nameIsValid = isset($_POST['name']) && !empty($_POST['name']);
        //$premiumIsValid = isset($_POST['isPremium']) && !empty($_POST['isPremium']);
        $linkIsValid = isset($_POST['link']) && !empty($_POST['link']);
        $signatoryIsValid = isset($_POST['signatory']) && !empty($_POST['signatory']);
        $expiresIsValid = isset($_POST['expireAt']) && !empty($_POST['expireAt']);
        $destinationsIsValid = isset($_POST['destinations']) && !empty($_POST['destinations']);
        $pricesIsValid = isset($_POST['prices']) && !empty($_POST['prices']);

        if (
            $nameIsValid && 
            $linkIsValid && 
            $signatoryIsValid && 
            $expiresIsValid && 
            $destinationsIsValid && 
            $pricesIsValid
        ) {
            global $bdd;

            $isPremium = (isset($_POST['isPremium']))?1:0;

            $manager = new ManagerRepository($bdd);
            $idTO = $manager->createTourOperator($_POST['name'], $isPremium, $_POST['link']);
            if ($idTO !== -1) {
                $certificateIsAdded = $manager->createCertificate($idTO, $_POST['signatory'], $_POST['expireAt']);
                $destinationIsAdded = $manager->createDestination($idTO, $_POST['destinations'], $_POST['prices']);
            }

            if ($idTO !== -1 && $destinationIsAdded && $certificateIsAdded) {
                $result['status'] = 'success';
                $result['message'] = 'Nouveau Tour Operator ajouté.';

                return $result;
            } else {
                return $result;
            }
        } else {
            $result['message'] = 'Le formulaire contient des erreurs.';

            return $result;
        }
    }

    return [];
}


function getImage($destination) {
    global $bdd;
    $managerRepo = new ManagerRepository($bdd);
    $destinations = $managerRepo->getAllDestination();
    $destinationString = [];
    
    foreach ($destinations as $location){
        $destinationString[] = strtolower($location->getLocation());
    }

    if (in_array(strtolower($destination), $destinationString)){
        return "./assets/img/". strtolower($destination) .".jpg";
    }
    
}


?>
    
