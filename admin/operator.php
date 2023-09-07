<?php

include_once('../utils/db_connect.php');
include_once('../utils/loadClass.php');
include_once('../partials/headerAdmin.php');
require_once('../utils/functions.php');

$managerRepo = new ManagerRepository($bdd);
$oneOperator = $managerRepo->getAllDestinationForOneOperator($_GET['id']);
var_dump($oneOperator);

?>

<section>
    <h1><?= $oneOperator->getName() ?></h1>
    <table class="uk-table uk-table-divider">
        <thead>
            <tr>
                <th>Location</th>
                <th>Certificate</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> <?= $oneOperator->getDestinations()[0]->getLocation() ?></td>
                <td> <?= $oneOperator->getDestinations()[0]->getLocation() ?></td>
                <td> <?= $oneOperator->getDestinations()[0]->getPrice() ?></td>
            </tr>
        </tbody>
    </table>
</section>


<?php

include_once('../partials/footer.php');

?>