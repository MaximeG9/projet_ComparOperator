<?php

include_once('./utils/db_connect.php');
include_once('./utils/loadClass.php');
include_once('./partials/header.php');


?>


<form action="./operator-list.php" method="post" class="uk-search uk-search-default">
    <div>
        <input class="uk-search-input" type="search" name="search">
    </div>
    <div>
        <button type="submit">rechercher</button>
    </div>
</form>







<?php
include_once('./partials/footer.php');
