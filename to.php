<?php

include_once('./utils/db_connect.php');
include_once('./utils/loadClass.php');
include_once('./partials/header.php');
require_once('./utils/functions.php');

$managerRepo = new ManagerRepository($bdd);



if ($oneOperator == NULL) {
    echo '<div>TO not found</div>';
} else { ?>
    <div>
        <!-- titre -->
    </div>
    <div>
        <!-- note -->
    </div>
    <div>
        <!-- commentaire -->
    </div>
<?php }





include_once('../partials/footer.php');

?>


