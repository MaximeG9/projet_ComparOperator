<?php

include_once('../utils/db_connect.php');
include_once('../utils/loadClass.php');
include_once('../partials/headerAdmin.php');
require_once('../utils/functions.php');


login()

?>



<section>
    <a href="" class="logo" target="_blank">
    </a>

    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <h6 class="mb-0 pb-3"><span>Log In </span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Log In</h4>
                                            <form action="../admin/dashboard.php" method="post">
                                                <div class="form-group">
                                                    <input type="text" name="login" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <button class="btn mt-4">submit</button>
                                                <p class="mb-0 mt-4 text-center"><a href="#0" class="link">Forgot your password?</a></p>
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
