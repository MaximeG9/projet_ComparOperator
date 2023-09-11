<?php

include_once('../utils/db_connect.php');
include_once('../utils/loadClass.php');
include_once('../partials/headerAdmin.php');
require_once('../utils/functions.php');

if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {

$managerRepo = new ManagerRepository($bdd);

if (isset($_GET['id'])) {
    if (isset($_POST['modify'])) {
        $managerRepo->modifyDestination($_POST['id'], $_POST['location'], $_POST['price']);
    }

    if (isset($_POST['delete'])) {
        $managerRepo->deleteLocation($_POST['id']);
    }

    $oneOperator = $managerRepo->getAllDestinationForOneOperator($_GET['id']);
    $destination = $managerRepo->getDestination();


    // var_dump($oneOperator);


    if ($oneOperator == NULL) { ?>

<div class="uk-flex uk-flex-center uk-flex-middle" uk-height-viewport="offset-top: true">
    <p class="uk-text-large uk-text-bold">
        TO not found.
    <p>
</div>

<?php    } else {

?>

        <section class="operator uk-padding-bottom">
            <div class="container">
                <div>
                    <div>
                        <h4 class="pt-5 pb-4">Tour Operator : <?= $oneOperator->getName() ?></h4>
                        <p>Signatory : <?= $oneOperator->getCertificate()->getSignatory() ?></p>
                        <p class="pb-3">Certificate Expire At : <?= $oneOperator->getCertificate()->getExpiresAt() ?></p>
                    </div>
                    <div>

                        <a class="uk-button uk-button-primary" href="#modal-sections" uk-toggle>Add Location</a>

                        <div id="modal-sections" uk-modal>
                            <div class="uk-modal-dialog">
                            <form action="/admin/operator.php?id=<?= $oneOperator->getId() ?>" method="post">
                                    <div class="uk-modal-header">
                                        <h2 class="uk-modal-title">ADD CITY</h2>
                                    </div>
                                    <div class="uk-padding">
                                        <div class="uk-margin">
                                            <label for="location">Select an existing location </label>
                                            <select name="location" id="location" class="uk-select"><?= $destination ?></select>
                                        </div>
                                        <div class="uk-margin">
                                            <label for="newLocation">Create a new location </label>
                                            <input type="text" placeholder="Location" name="newLocation" id="newLocation" class="uk-input">
                                        </div>
                                    </div>
                                    <div class="uk-modal-footer uk-text-right">
                                        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                                        <button class="uk-button uk-button-primary" type="submit">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-overflow-auto">
                    <table class="uk-table uk-table-divider">
                        <thead>
                            <tr>
                                <th>Location</th>
                                <th>Price</th>
                                <th>Modify</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <?php foreach ($oneOperator->getDestinations() as $destinations) { ?>
                            <tbody>
                                <tr>
                                    <form action="" method="post">
                                        <td> <input type="text" name="location" value="<?= $destinations->getLocation() ?>" class="uk-input uk-width-small"></td>
                                        <td> <input type="text" name="price" value="<?= $destinations->getPrice() ?>" class="uk-input uk-width-small"> </td>
                                            <input type="hidden" name="id" value="<?= $destinations->getId() ?>">
                                        <td><button class="uk-button uk-button-primary" name="modify">Modify</button></td>
                                        <td><button class="uk-button uk-button-danger" name="delete">Delete</button></td>
                                    </form>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </section>


<?php
    }
} else { ?>

<div class="uk-flex uk-flex-center uk-flex-middle" uk-height-viewport="offset-top: true">
    <p class="uk-text-large uk-text-bold">
        Page not found.
    <p>
</div>

<?php }


} else {
    include_once('../partials/no-login.php');
}

include_once('../partials/footer.php');

?>
