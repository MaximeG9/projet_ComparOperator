<?php

session_start();

if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
    if ($_SERVER['REQUEST_URI'] === '/admin/' || $_SERVER['REQUEST_URI'] === '/admin/index.php') {
        header('Location: /admin/dashboard.php');
    }
}

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
<body class="admin-pages">
<?php if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) { ?>
    <nav class="uk-navbar-container">
        <div class="uk-container">
            <div uk-navbar>

                <div class="uk-navbar-left">
                    <ul class="uk-navbar-nav">
                        <li><img src="../assets/svg/plane.svg" height="50px" width="50px" alt=""></li>
                        <li><img src="../assets/svg/sun.svg" height="50px" width="50px" alt=""></li>
                        <li><img src="../assets/svg/palm.svg" height="50px" width="50px" alt=""></li>
                        <li><img src="../assets/svg/parasol.svg" height="50px" width="50px" alt="" class="uk-visible@s"></li>
                        <li><img src="../assets/svg/like.svg" height="50px" width="50px" alt="" class="uk-visible@s"></li>
                    </ul>
                </div>

                <div class="uk-navbar-right uk-hidden@m">
                    <a class="uk-navbar-toggle uk-navbar-toggle-animate" uk-navbar-toggle-icon href="#"></a>
                    <div class="uk-navbar-dropdown">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li><a href="/admin/dashboard.php">Dashboard</a></li>
                            <li><a href="/admin/add-tour.php">Ajouter un TO</a></li>
                            <li><a href="/" target="_blank">Voir le site</a></li>
                            <li class="uk-text-center">
                                <form action="/admin/index.php" method="post">
                                    <button name="logout" value="1" class="uk-button uk-button-text">
                                        <span uk-icon="icon: sign-out"></span>
                                        Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="uk-navbar-right uk-visible@m">
                    <ul class="uk-navbar-nav">
                        <li><a href="/admin/dashboard.php">Dashboard</a></li>
                        <li><a href="/admin/add-tour.php">Ajouter un TO</a></li>
                        <li><a href="/" target="_blank">Voir le site</a></li>
                        <li class="uk-text-center">
                            <form action="/admin/index.php" method="post" class="uk-height-1-1 uk-flex uk-flex-center">
                                <button name="logout" value="1" class="uk-button uk-button-link">
                                    <span uk-icon="icon: sign-out"></span>
                                    Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
<?php } ?>
