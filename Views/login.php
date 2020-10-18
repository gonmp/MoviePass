<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Login</h2>
               <form action="<?php echo FRONT_ROOT ?>User/Login" method="post" class="bg-light-alpha p-5">
                    <div class="row">                                                  
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">User</label>
                                   <input type="text" name="user" value="" class="form-control">
                              </div>
                              
                              <div class="form-group">
                                   <label for="">Password</label>
                                   <input type="text" name="password" value="" class="form-control">
                              </div>

                              <div class="form-group">
                                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Login</button></div>                              
                                <button type="button" href="" name="button" class="btn btn-dark ml-auto d-block">Register new user</button>
                              </div>
                         </div>                                                  
                    </div>                    
               </form>
          </div>
     </section>
</main>