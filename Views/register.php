<?php
    require_once('nav.php');
?>

<main class="">
    <section id="register" class="">
        <div class="container">
            <form action="<?php echo FRONT_ROOT ?>User/Add" method="post" class="p-3">
                
                <div class="row">
                    <div class="col-4">
                        <label for="" class="text-danger h2">user name</label>                                        
                        <input type="text" name="userName" class="text-white form-control border-primary bg-dark" required value="" minlength="1" maxlength="10" placeholder="enter your user name here" pattern="[A-Za-z0-9 ]+" title="only letters and numbers">
                        
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

                    </div>
                </div>
                            
                <div class="row">
                    <div class="col-4">
                        <label for="" class="mt-3 text-danger h2">password</label>                    
                        <input type="password" name="password" class="text-white form-control border-primary bg-dark" required value="" minlength="1" maxlength="10" placeholder="write your password here">
                    </div>                           
                </div>    

                <div class="row">
                    <div class="col-4 mt-4">
                        <button type="submit" name="button" class="btn btn-lg btn-success float-right">Register</button>                
                        <a href="<?php echo FRONT_ROOT ?>Home/Index"  class="mx-3 btn btn-sm btn-danger float-right">Cancel</a>                
                    </div>       
                </div>       
                

            </form>            

            <div>
                
            </div>

        </div>
    </section>
</main>
    

