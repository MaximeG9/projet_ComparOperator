<?php

include_once('./utils/db_connect.php');
include_once('./utils/loadClass.php');
include_once('./partials/header.php');

$managerRepo = new ManagerRepository($bdd);
$allTours = $managerRepo->getAllDestination();
// var_dump($allTours);
?>

<div class="uk-container">
    <form action="./operator-list.php" method="post" class="uk-search uk-search-default">
        <div>
            <input class="uk-search-input" type="search" name="search">
            <input type="hidden" name="id_destination">
        </div>
        <div>
            <button type="submit">rechercher</button>
        </div>
    </form>
</div>

</div>











<?php
include_once('./partials/footer.php');
