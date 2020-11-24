<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="cinemaAdd">
        
        <div class="container">
            <div class="row m-0 mt-2 pb-2 mb-0 border border-secondary border-bottom-0 transparentPanel">            
                
                <form class="p-2" action="<?php echo FRONT_ROOT ?>Cinema/Add" method="post">           

                <h1 class="text-danger">Add Cinema</h1>           
                
                <div class="row">

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
                        <button type="submit" class="btn btn-success px-5">ADD</button>                        
                    </div>                
                </div>
            </form>
            </div>
        </div>
    </section>
</main>