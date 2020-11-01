<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <span class="navbar-text">
        <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Index"><strong>HOME</strong> </a>
    </span>
</nav>

<main class="py-5">
    <section id="Add Cine" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Register User<h2>
            
            

            <form action="<?php echo FRONT_ROOT ?>User/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">                         
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">User</label>
                            <input type="text" pattern="[A-Za-z0-9 ]+" title="Only letters and numbers" name="userName" value="" class="form-control" minlength="5" maxlength="10" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" value="" class="form-control" minlength="5" maxlength="10" required>
                        </div>
                    </div>
                </div>                
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Register</button>
            </form>
        </div>
    </section>
</main>
    

