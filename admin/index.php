<?php

include_once('../utils/db_connect.php');
include_once('../utils/loadClass.php');
include_once('../partials/headerAdmin.php');
require_once('../utils/functions.php');

if (isset($_GET['status'])) {
?>

<div class="uk-alert-warning uk-position-fixed uk-position-small uk-position-top-center" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <p class="uk-margin-large-right"><?= $_GET['status'] ?></p>
</div>

<?php
}
?>

<section class="login">
    <a href="" class="logo" target="_blank">
    </a>

    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">                        
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Log In</h4>
                                            <form action="/admin/auth.php" method="post">
                                                <div class="form-group">
                                                    <input type="text" name="login" class="form-style" value="Maxime" id="logemail" autocomplete="off">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style" value="RootRoot" id="logpass" autocomplete="off">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <button class="btn mt-4">Connexion</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php
include_once('../partials/footer.php');
