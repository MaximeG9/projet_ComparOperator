<?php

include_once('./utils/db_connect.php');
include_once('./utils/loadClass.php');
include_once('./partials/header.php');
require_once('./utils/functions.php');

$managerRepo = new ManagerRepository($bdd);
$tourOperators = $managerRepo->getOperatorsByDestination($_POST['search']);

// var_dump($tourOperators);

if (count($tourOperators) > 0) {

$imageCover = getImage($tourOperators[0]->getDestinations()[0]->getLocation());
?>

<section class="uk-cover-container uk-light" uk-height-viewport>

    <img src="<?= $imageCover ?>" alt="background-cover-destination" uk-cover />

    <div class="uk-container">
        <div class="uk-flex uk-flex-center uk-flex-middle">
            <div class="searchresult uk-padding-small uk-margin-large-top uk-margin-large-bottom uk-position-z-index">
                <h3><?php echo "Votre recherche pour la destination : " . $tourOperators[0]->getDestinations()[0]->getLocation(); ?></h3>
            </div>
        </div>

        <div class="uk-flex-center uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@xl uk-margin-large-bottom" uk-grid>
            <?php foreach ($tourOperators as $tourOperator) {
                $destinations = $tourOperator->getDestinations();
            ?>

                <div>
                <a href="/to.php?id=<?= $tourOperator->getId() ?>">
                        <div class="uk-card uk-card-default uk-card-body uk-card-hover uk-overlay uk-overlay-default ">
                            <div>
                                <h3 class="uk-card-title"><?= $tourOperator->getName() ?></h3>

                                <?php foreach ($destinations as $destination) { ?>
                                    <p>Destination : <?= $destination->getLocation() ?></p>
                                    <p>Prix : <?= $destination->getPrice() ?> Eur</p>
                                <?php } ?>
                            </div>
                        </div>
                    </a>
                </div>
        
            <?php } ?>
        </div>
    </div>
</section>
<?php } else { ?>
    <div class="uk-flex uk-flex-column uk-flex-center uk-flex-middle" uk-height-viewport="offset-top: true">
        <p class="uk-text-large uk-text-bold uk-padding">La destination "<?= $_POST['search'] ?>" n'est pas proposée.</p>
        <p><a href="/" class="uk-button uk-button-default">Réessayer</a></p>
    </div>
<?php
                        
} 

include_once('./partials/footer.php');
