<div class="row p-0 m-0 ">
    <div class="col pl-5 ml-5">
       <strong><p class="text-capitalize m-0 p-0 text-white mText"><?php echo 'Hello ' . $_SESSION['userLogged']->GetUserName(); ?></p></strong>
    </div>
    <div class="col ml-5">
        <a href="<?php echo FRONT_ROOT ?>Home/Logout" class="mBtn rounded-0 btn btn-outline-danger text-white">log out</a>
    </div>    
</div>