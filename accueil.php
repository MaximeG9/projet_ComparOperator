<?php

include_once('./utils/db_connect.php');
include_once('./utils/loadClass.php');
include_once('./partials/header.php');

$managerRepo = new ManagerRepository($bdd);
$allTours = $managerRepo->getAllDestination();
// var_dump($allTours);
?>

<div class="bg-plane uk-column-1">
    <div class="uk-container">
        <div class="uk-flex uk-flex-center uk-flex-middle uk-text-center uk-margin-large-top">
            <h3 class="uk-secondary">Nos destinations : LONDRES, MONACO, TUNIS, ROME.</h3>
        </div>
        <div class="uk-flex uk-flex-center uk-flex-middle">
            <hr class="uk-divider-small">
        </div>
        <div class="uk-flex uk-flex-center uk-flex-middle" uk-height-viewport="offset-top: true">
            <form action="/operator-list.php" method="post" class="uk-search uk-search-default">
                <div class="uk-margin">
                    <input class="uk-search-input uk-form-large" type="search" name="search" placeholder="Votre destination">
                </div>
                <div class="uk-margin">
                    <button type="submit" class="uk-button uk-button-primary uk-button-large uk-width-1-1">Rechercher</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
include_once('./partials/footer.php');
