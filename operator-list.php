<?php

include_once('./utils/db_connect.php');
include_once('./utils/loadClass.php');
include_once('./partials/header.php');
require_once('./utils/functions.php');



$managerRepo = new ManagerRepository($bdd);
$tourOperators = $managerRepo->getOperatorsByDestination($_POST['search']);



// var_dump($tourOperators);



?>


<section>
    <?php $imageCover = getImage($tourOperators[0]->getDestinations()[0]->getLocation()); ?>
    <div class="bg-destination" style="background : url(<?= $imageCover ?>)bottom fixed ; background-size : cover;">
        <?php

        ?>


        <?php
        if (count($tourOperators) > 0) {
            getImage($tourOperators[0]->getDestinations()[0]->getLocation());
        ?>
            <div class="uk-container">
                <div class="uk-flex uk-flex-center">
                    <div class="searchresult uk-padding-small uk-margin-large-top uk-margin-large-bottom">
                        <h3><?php echo "Votre recherche pour la destination : " . $tourOperators[0]->getDestinations()[0]->getLocation(); ?></h3>
                    </div>
                </div>


                <div class="uk-flex uk-grid-row-large uk-text-center">
                    <?php foreach ($tourOperators as $tourOperator) {
                        $destinations = $tourOperator->getDestinations();
                    ?>


                        <a href="./to.php" class="uk-flex-auto uk-width-1-3">
                            <div class="uk-card uk-card-default uk-card-body uk-card-hover uk-overlay uk-overlay-default ">
                                <div>
                                    <h3 class="uk-card-title"><?= $tourOperator->getName() ?></h3>

                                    <?php foreach ($destinations as $destination) { ?>
                                        <!-- // var_dump($destination);  -->

                                        <p>Destination : <?= $destination->getLocation() ?></p>
                                        <p>Prix : <?= $destination->getPrice() ?> </p>
                                    <?php } ?>
                                </div>
                            </div>
                        </a>
                
        <?php }
        echo "</div>";
                } else {
                    echo "La destination " . $_POST['search'] . " n'est pas proposée.";
                }
        ?>
            </div>

    </div>
</section>




<?php
include_once('./partials/footer.php');
