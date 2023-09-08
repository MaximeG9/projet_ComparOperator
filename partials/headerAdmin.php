<?php

session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: /admin/index.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.16.24/dist/css/uikit.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
<?php

    if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) { ?>
    <form action="/admin/index.php" method="post">
        <button name="logout" value="1" class="uk-button uk-button-default">
            <span uk-icon="icon: sign-out"></span>
            Déconnexion
        </button>
    </form>
    <?php } ?>
