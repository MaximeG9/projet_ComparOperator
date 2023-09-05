<?php

include_once('../utils/db_connect.php');
include_once('../utils/loadClass.php');
include_once('../partials/headerAdmin.php');

function getOperators()
{
    $manager = new ManagerRepository($bdd);
    
    return $manager->geAllOperator();
}

function showOperators()
{
    if (isset($_POST['search-tour-operator']) && isset($_POST['search'])) {
        if (!empty($_POST['search'])) {
            return getOperators($_POST['search']);
        } 
    } else {
        return getOperators();
    }
}

$operators = showOperators();
?>

<a href="/admin/add-tour.php" class="uk-button uk-button-primary uk-width-1-1">
    <span uk-icon="plus"></span>
    Ajouter un Tour Operator
</a>

<div class="uk-text-center uk-width-1-1 uk-width-1-2@s uk-margin-auto uk-margin">
    <form action="/admin/dashboard.php" method="get">
        <div class="uk-margin">
            <input type="text" name="search" class="uk-input" placeholder="Tour Operator">
        </div>
        <div class="uk-margin">
            <button type="submit" name="search-tour-operator" value="search" class="uk-button uk-button-default">
                <span uk-icon="search"></span>
                Rechercher
            </button>
        </div>
    </form>
</div>

<section>
</section>

<?php

include_once('../partials/footer.php');

?>
