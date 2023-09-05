<?php

include_once('./utils/db_connect.php');
include_once('./utils/loadClass.php');
include_once('./partials/header.php');


?>

<div class="uk-column-1-2@s">
    <form class="uk-search uk-search-default">
        <input class="uk-search-input" type="search" placeholder="" aria-label="">
        <button type="submit">rechercher</button>
    </form>
</div>



<?php
include_once('./partials/footer.php');