<?php

include_once('../utils/db_connect.php');
include_once('../utils/loadClass.php');
include_once('../partials/headerAdmin.php');
include_once('../utils/functions.php');

if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
?>

<h2 class="uk-text-center">Ajouter un TO</h2>
<?php
$alert = addTour();

if (count($alert) > 0) include_once('../partials/alert.php');
?>

<form action="/admin/add-tour.php" method="post" class="uk-padding uk-width-1-1 uk-width-2-3@s uk-width-1-2@l uk-width-1-3@xl uk-margin-auto">
    <fieldset class="uk-fieldset">

        <legend class="uk-legend">Tour Operator</legend>

        <div class="uk-margin">
            <label for="name">Nom du TO :</label>
            <input name="name" class="uk-input" type="text" placeholder="nom du TO" aria-label="nom du TO">
        </div>

        <div class="uk-margin">
            <label><input class="uk-checkbox" type="checkbox" name="isPremium"> Premium</label>
        </div>

        <div class="uk-margin">
            <label for="link">Lien du TO :</label>
            <input name="link" class="uk-input" type="text" placeholder="Lien vers le site du TO" aria-label="Lien vers le site du TO">
        </div>

    </fieldset>

    <div class="uk-divider-icon"></div>

    <fieldset class="uk-fieldset">

        <legend class="uk-legend">Certificate</legend>

        <div class="uk-margin">
            <label for="signatory">Détenteur du certificat :</label>
            <input name="signatory" class="uk-input" type="text" placeholder="Propriétaire du certificat" aria-label="Propriétaire du certificat">
        </div>

        <div class="uk-margin">
            <label for="expireAt">Expire le :</label>
            <input name="expireAt" class="uk-input" type="text" placeholder="Expire le" aria-label="Expire le">
        </div>

    </fieldset>

    <div class="uk-divider-icon"></div>

    <fieldset class="uk-fieldset">

        <legend class="uk-legend">Destinations</legend>

        <div class="uk-margin">
            <label for="destinations">Destinations :</label>
            <input type="text" name="destinations" placeholder="Destinations" class="uk-input">
        </div>

        <div class="uk-margin">
            <label for="price">Prix:</label>
            <input type="text" name="prices" placeholder="Prix" class="uk-input">
        </div>

    </fieldset>

    <div class="uk-divider-icon"></div>

    <div><button type="submit" class="uk-button uk-button-primary">Ajouter</button></div>

</form>

<?php
} else {
    include_once('../partials/no-login.php');
}

include_once('../partials/footer.php');

?>
