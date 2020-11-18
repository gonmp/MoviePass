<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="cinemaAdd">
        
        <div class="container">
            <h1 class="text-danger px-2 pt-4">Add Cinema</h1>

            <form action="<?php echo FRONT_ROOT ?>Cinema/Add" method="post">           
                
                <div class="row pb-2">

                    <!-- nombre -->                
                    <div class="col">
                        <label for="" class="text-primary">name</label>
                        <input placeholder="cinema name" type="text" pattern="[A-Za-z0-9 ]+" title="only letters and numbers" name="name" value="" class="form-control" minlength="1" maxlength="50" required>
                    </div>

                    <!-- direccion -->
                    <div class="col">
                        <label for="" class="text-primary">address</label>
                        <input placeholder="cinema address" type="text" pattern="[A-Za-z0-9 ]+" title="Only letters and numbers" name="address" value="" class="form-control" minlength="1" maxlength="100" required>
                    </div>                  

                    <!-- boton agregar cine -->
                    <div class="col">  
                        <label for="" class="text-success d-block">add new cinema</label>
                        <button type="submit" class="btn btn-success my-0 px-5">ADD</button>                        
                    </div>                
                </div>
            </form>
        </div>
    </section>
</main>