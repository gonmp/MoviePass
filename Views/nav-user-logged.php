<div class="row p-0 m-0 ">
    <div class="col">
       <strong><p class="text-capitalize h4 text-white"><?php echo 'Hello ' . $_SESSION['userLogged']->GetUserName() . "!"; ?></p></strong>
    </div>
    <div class="col">
        <a href="<?php echo FRONT_ROOT ?>Home/Logout" class="rounded-0 btn btn-outline-danger text-white">log out</a>
    </div>    
</div>