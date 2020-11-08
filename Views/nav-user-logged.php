<div class="float-right mt-1 mx-5">
    <a href="<?php echo FRONT_ROOT ?>Home/Logout" class="mx-3 float-right btn btn-outline-danger btn-sm text-white">log out</a>
    <strong><p class="text-capitalize h4 d-inline text-white float-right"><?php echo 'Hello ' . $_SESSION['userLogged']->GetUserName() . " !"; ?></p></strong>
</div>