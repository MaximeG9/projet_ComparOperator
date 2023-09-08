<?php

include_once('./utils/db_connect.php');
include_once('./utils/loadClass.php');
include_once('./partials/header.php');
require_once('./utils/functions.php');

$managerRepo = new ManagerRepository($bdd);
$reviewsTour = $managerRepo->getReviewbyOperatorId();
var_dump($reviewsTour);

?>

