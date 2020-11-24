<?php
    require_once('nav.php');
?>

<main class="">
    <section id="register" class="">
        <div class="container">                                
            <div class="row m-0">            
                <div class="pb-4 transparentPanel mt-5 border border-bottom-0 border-secondary">                                                
                    <form action="<?php echo FRONT_ROOT ?>User/Add" method="post" class="p-3">
                        
                        <label class="d-block mTitle">WELCOME</label>
                        <label for="" class="mText">user name</label>                                        
                        <input type="text" name="userName" class="text-white form-control" required value="" minlength="1" maxlength="10" placeholder="enter your user name here" pattern="[A-Za-z0-9 ]+" title="only letters and numbers">
                                
                        <?php 
                            if(isset($_SESSION['error']))
                            {?>                            
                                <p class="text-warning py-0 mx-1"><?= $_SESSION['error'] ?></p>                            
                            <?php 
                            }
                            else
                            {
                                ?><p class="py-1"></p><?php
                            }
                        ?>                         

                        <label for="" class="mt-3 mText">password</label>                    
                        <input type="password" name="password" class="text-white form-control" required value="" minlength="1" maxlength="10" placeholder="write your password here">
                        
                        
                        <div class="mt-4">
                            <button type="submit" name="button" class="btn btn-lg btn-outline-success float-right mBtn">Register</button>                
                            <a href="<?php echo FRONT_ROOT ?>Home/Index"  class="mx-3 btn btn-sm btn-outline-danger float-right mBtn">Cancel</a>                                    
                        </div>
                    </form>                            
                </div>
            </div>
        </div>
    </section>
</main>
    

