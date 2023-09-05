<?php

include_once('./utils/db_connect.php');
include_once('./utils/loadClass.php');
include_once('./partials/header.php');
require_once('./utils/functions.php');



$managerRepo = new ManagerRepository($bdd);
$managerRepo->getOperatorByDestination();
$operatorDest = $managerRepo->getOperatorByDestination();

$managerRepo->getAllDestination();
$allDest = $managerRepo->getAllDestination();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    foreach ($operatorDest as $operator){ ?>
    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
        <div class="uk-card-media-left uk-cover-container">
            <img src="images/light.jpg" alt="" uk-cover>
            <canvas width="600" height="400"></canvas>
        </div>
        <div>
            <div class="uk-card-body">
                <h3 class="uk-card-title"><?= $operator->getName() ?></h3>

                <?php foreach ($allDest as $destination) { ?>

                <p>Destination : <?= $operator->getDestinations() ?></p>
                <p>Prix : <?= $operator->getPrice() ?> </p>
                <p></p>
                <p></p>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
</body>

</html>



<?php
include_once('./partials/footer.php');
