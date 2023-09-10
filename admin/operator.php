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


    if ($oneOperator == NULL) {
        echo '<div>TO not found</div>';
    } else {

?>

        <section class="operator">
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
                                <button class="uk-modal-close-default" type="button" uk-close></button>
                                <div class="uk-modal-header">
                                    <h2 class="uk-modal-title">ADD CITY</h2>
                                </div>
                                <form action="">
                                    <div>
                                        <p>Select an existing location </p>
                                        <select name="location" id=""><?= $destination ?></select>
                                    </div>
                                    <div>
                                        <p>Create a new location </p>
                                        <input type="text" value="Location" name="Location">
                                    </div>
                                </form>
                                <div class="uk-modal-footer uk-text-right">
                                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                                    <button class="uk-button uk-button-primary" type="button">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="uk-table uk-table-divider">
                    <thead>
                        <tr>
                            <th>Location</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <?php foreach ($oneOperator->getDestinations() as $destinations) { ?>
                        <tbody>
                            <tr>
                                <form action="" method="post">
                                    <td> <input type="text" name="location" value="<?= $destinations->getLocation() ?>"></td>
                                    <td> <input type="text" name="price" value="<?= $destinations->getPrice() ?>" </td>
                                        <input type="hidden" name="id" value="<?= $destinations->getId() ?>">
                                    <td><button class="uk-button uk-button-primary" name="modify">Modify</button></td>
                                    <td><button class="uk-button uk-button-danger" name="delete">Delete</button></td>
                                </form>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </section>


<?php
    }
} else {

    echo '<div>Page not found</div>';
}


} else {
    include_once('../partials/no-login.php');
}

include_once('../partials/footer.php');

?>
