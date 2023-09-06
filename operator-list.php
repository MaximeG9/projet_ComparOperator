<?php

include_once('./utils/db_connect.php');
include_once('./utils/loadClass.php');
include_once('./partials/header.php');
require_once('./utils/functions.php');



$managerRepo = new ManagerRepository($bdd);
$tourOperators = $managerRepo->getOperatorsByDestination($_POST['search']);



var_dump($tourOperators);



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
    if (count($tourOperators) > 0) {
        echo $tourOperators[0]->getDestinations()[0]->getLocation();
        foreach ($tourOperators as $tourOperator) {
            $destinations = $tourOperator->getDestinations();
    ?>

            <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                <div class="uk-card-media-left uk-cover-container">
                    <img src="images/light.jpg" alt="" uk-cover>
                    <canvas width="600" height="400"></canvas>
                </div>
                <div>
                    <div class="uk-card-body">
                        <h3 class="uk-card-title"><?= $tourOperator->getName() ?></h3>

                        <?php foreach ($destinations as $destination) { ?>
                            <!-- // var_dump($destination);  -->

                            <p>Destination : <?= $destination->getLocation() ?></p>
                            <p>Prix : <?= $destination->getPrice() ?> </p>
                            <p></p>
                            <p></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
    <?php }
    } else {
        echo "La destination " . $_POST['search'] . " n'est pas proposée.";
    }
    ?>

</body>

</html>



<?php
include_once('./partials/footer.php');
