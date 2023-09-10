<?php

include_once('../utils/db_connect.php');
include_once('../utils/loadClass.php');
include_once('../partials/headerAdmin.php');

function getOperators($search = NULL)
{
    global $bdd;
    $manager = new ManagerRepository($bdd);
    
    return $manager->getAllOperator(NULL);
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

if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {

$operators = showOperators();
?>

<div class="uk-container uk-flex uk-flex-center uk-flex-middle uk-margin-large">
    <form action="/admin/dashboard.php" method="post" class="uk-search uk-search-default">
        <div class="uk-margin">
            <input class="uk-search-input uk-form-large" type="search" name="search" placeholder="Tour Operator">
        </div>
        <div class="uk-margin">
            <button type="submit" name="filterTO" value="1" class="uk-button uk-button-primary uk-button-large uk-width-1-1">Rechercher</button>
        </div>
    </form>
</div>

<section class="uk-container">
    <div class="uk-flex-center uk-grid-large uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@xl uk-margin-large-bottom uk-margin-remove-left" uk-grid>
    <?php
    foreach ($operators as $operator) { 
        $premium = ($operator->getIsPremium())?'premium':'normal';
        $isChecked = ($premium === 'premium')?'checked':'';
    ?>
        <div class="uk-panel uk-background-default uk-border-rounded uk-box-shadow-small uk-padding-small uk-margin-left">
            <p><a href="/admin/operator.php?id=<?= $operator->getId() ?>"><?= $operator->getName() ?></a></p>
            <p class="uk-margin">
                <label>
                    <input type="checkbox" name="isPremium" value="<?= $premium ?>" <?= $isChecked ?> class="uk-checkbox">
                    Premium
                </label>
            </p>
            <p><a href="<?= $operator->getLink() ?>" target="_blank"><?= $operator->getLink() ?></a></p>
            <p><a href="/admin/dashboard.php?delete=<?= $operator->getId() ?>" class="uk-button uk-button-danger">Supprimer</a></p>
        </div>
    <?php } ?>
    </div>
</section>

<?php

} else {
    include_once('../partials/no-login.php');
}

include_once('../partials/footer.php');

?>
