<?php
    require_once('nav.php');
?>
<main class="py-5">
    <section id="Add Cine" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Register User<h2>
            <form action="<?php echo FRONT_ROOT ?>User/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">                         
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">User</label>
                            <input type="text" name="userName" value="" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" name="password" value="" class="form-control">
                        </div>
                    </div>
                </div>                
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Register</button>
            </form>
        </div>
    </section>
</main>
    

