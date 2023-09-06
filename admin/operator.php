<?php

include_once('../utils/db_connect.php');
include_once('../utils/loadClass.php');
include_once('../partials/headerAdmin.php');
require_once('../utils/functions.php');

$managerRepo = new ManagerRepository($bdd);
$oneOperator = $managerRepo->getAllDestinationForOneOperator($_GET['id']);
var_dump($oneOperator);
?>