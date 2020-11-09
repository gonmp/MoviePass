<?php
     require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">                              
               <h2 class="mb-4">Login</h2>                             
               <form action="<?php echo FRONT_ROOT ?>User/Login" method="post" class="bg-light-alpha p-5">
                    <div class="row">                                                  
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">User</label>
                                   <input type="text" pattern="[A-Za-z0-9 ]+" title="only letters and numbers" name="name" value="" class="form-control" minlength="1" maxlength="10" required>
                              </div>
                              
                              <div class="form-group">
                                   <label for="">Password</label>
                                   <input type="password" name="password" value="" class="form-control" minlength="1" maxlength="10" required>
                              </div>

                              <div class="form-group">
                                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Login</button>                                
                                <br>
                                <a class="btn btn-dark ml-auto d-block" href="<?php echo FRONT_ROOT ?>User/ShowRegisterView">Register</a>
                              </div>
                              <div>                            
                                   <?php if(isset($_SESSION['error'])){?> 
                                   <p class="btn btn-dark"> <?= $_SESSION['error'] ?></p> <?php } ?>                                          
                              </div>                              
                         </div>                                                  
                    </div>                    
               </form>
          </div>
     </section>
</main>



<!--
     <main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Login</h2>                             
               <form action="<?php echo FRONT_ROOT ?>User/Login" method="post" class="bg-light-alpha p-5">
                    <div class="row">                                                  
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">User</label>
                                   <input type="text" pattern="[A-Za-z0-9 ]+" title="Only letters and numbers" name="name" value="" class="form-control" minlength="5" maxlength="10" required>
                              </div>
                              
                              <div class="form-group">
                                   <label for="">Password</label>
                                   <input type="password" name="password" value="" class="form-control" minlength="5" maxlength="10" required>
                              </div>

                              <div class="form-group">
                                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Login</button>                                
                                <br>
                                <a class="btn btn-dark ml-auto d-block" href="<?php echo FRONT_ROOT ?>User/ShowRegisterView">Register</a>
                              </div>
                              <div>                            
                              <?php if(isset($_SESSION['error'])){?> 
                                   <p class="btn btn-dark"> <?= $_SESSION['error'] ?></p> <?php } ?>                                          
                              </div>                              
                         </div>                                                  
                    </div>                    
               </form>
          </div>
     </section>
</main>

-->