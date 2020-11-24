<form action="<?php echo FRONT_ROOT ?>User/Login" method="post"> 

<div class="row">
    <div class="col-8">
        <input type="text" name="name" value="" placeholder="user name" title="only letters and numbers" pattern="[A-Za-z0-9 ]+" required class="form-control-sm bg-dark-x text-white border border-primary m-0 p-1">
        <input type="password" name="password" value="" placeholder="password" title="only letters and numbers" pattern="[A-Za-z0-9 ]+" required class="form-control-sm bg-dark-x text-white border border-primary m-0 p-1">
    </div>

    <div class="col">
        <button type="submit" class="btn btn-outline-primary btn-sm text-white">Login</button>
        <a href="<?php echo FRONT_ROOT ?>User/ShowRegisterView" class="btn btn-outline-danger btn-sm text-white">Register</a>
    </div>

    <?php 
    if (isset($_SESSION['error']) && $_SESSION['error'] != null)
    {?>
        <div class="row float-left">
            <div class="col">
                <p class="mb-0 text-warning"><?php echo $_SESSION['error'];?></p>            
            </div>
        </div>
        <?php    
    }?>
</div>
</form>
