<form action="<?php echo FRONT_ROOT ?>User/Login" method="post"> 

    <div class="float-left py-1 mx-0">
        <input type="text" name="name" value="" placeholder="user name" title="only letters and numbers" pattern="[A-Za-z0-9 ]+" required class="form-control-sm bg-dark-x text-white border border-primary">
        <input type="password" name="password" value="" placeholder="password" title="only letters and numbers" pattern="[A-Za-z0-9 ]+" required class="form-control-sm bg-dark-x text-white border border-primary">
    </div>

    <div class="float-left py-1 mx-3">
        <button type="submit" class="btn btn-outline-primary btn-sm text-white">Login</button>
        <a href="<?php echo FRONT_ROOT ?>User/ShowRegisterView" class="mx-1 btn btn-outline-danger btn-sm text-white">Register</a>
    </div>

    <?php 
    if ($_SESSION['error'] != null)
    {    
        ?>
        <div class="float-left mx-1">
            <p class="text-warning"><?php echo $_SESSION['error'];?></p>
        </div>
        <?php    
    }?>
</form>
