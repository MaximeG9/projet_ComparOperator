<?php
if ($_SERVER['REQUEST_URI'] === '/operator-list.php') {
    if (!isset($_POST['search'])) {
        // $_SERVER['DOCUMENT_ROOT'];
        header('Location: localhost/');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.16.24/dist/css/uikit.min.css" />
    <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>
    <nav class="uk-navbar-container">
        <div class="uk-container">
            <div uk-navbar>

                <div class="uk-navbar-left">
                    <ul class="uk-navbar-nav">
                        <li><img src="./assets/svg/plane.svg" height="50px" width="50px" alt=""></li>
                        <li><img src="./assets/svg/sun.svg" height="50px" width="50px" alt=""></li>
                        <li><img src="./assets/svg/palm.svg" height="50px" width="50px" alt=""></li>
                        <li><img src="./assets/svg/parasol.svg" height="50px" width="50px" alt="" class="uk-visible@s"></li>
                        <li><img src="./assets/svg/like.svg" height="50px" width="50px" alt="" class="uk-visible@s"></li>
                    </ul>
                </div>

                <div class="uk-navbar-right uk-hidden@m">
                    <a class="uk-navbar-toggle uk-navbar-toggle-animate" uk-navbar-toggle-icon href="#"></a>
                    <div class="uk-navbar-dropdown">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li><a href="../accueil.php">Accueil</a></li>
                            <li><a href="#">Dernières minutes</a></li>
                            <li><a href="../admin/index.php">Admin</a></li>
                        </ul>
                    </div>
                </div>

                <div class="uk-navbar-right uk-visible@m">
                    <ul class="uk-navbar-nav">
                        <li><a href="../accueil.php">Accueil</a></li>
                        <li><a href="#">Dernières minutes</a></li>
                        <li><a href="../admin/index.php">Admin</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
