<?php

include_once('./utils/db_connect.php');
include_once('./utils/loadClass.php');
include_once('./partials/header.php');
require_once('./utils/functions.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $managerRepo = new ManagerRepository($bdd);
    $tour = $managerRepo->getReviewbyOperatorId($_GET['id']);

    $rp = new ReflectionProperty('TourOperator', 'id');

    if ($rp->isInitialized($tour)) {
?>

<section>
    <h2><?= $tour->getName() ?></h2>
    <h3><?= $tour->getLink() ?></h3>
</section>

<?php } else { ?>

<div class="uk-flex uk-flex-center uk-flex-middle" uk-height-viewport="offset-top: true">
    <p class="uk-text-large uk-text-bold uk-text-center">
       Impossible de trouver ce Tour Operator. 
    <p>
</div>

<?php }
} else {
?>

<div class="uk-flex uk-flex-center uk-flex-middle" uk-height-viewport="offset-top: true">
    <p class="uk-text-large uk-text-bold">
       Cette page n'existe pas. 
    <p>
</div>

<?php
}

include_once('./partials/footer.php');

?>

