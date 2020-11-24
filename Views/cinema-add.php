<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="cinemaAdd">
        
        <div class="container">
            <div class="row m-0 mt-2 pb-2 mb-0 rounded border border-primary border-bottom-0 transparentPanel">            
                
                <form class="p-2" action="<?php echo FRONT_ROOT ?>Cinema/Add" method="post">           

                <h1 class="mText text-white" style="font-size: 3rem">Add New<span class="text-danger"> Cinema</span></h1>           
                
                <div class="row">

                    <!-- nombre -->                
                    <div class="col">
                        <label for="" class="mText">name</label>
                        <input placeholder="cinema name" type="text" pattern="[A-Za-z0-9 ]+" title="only letters and numbers" name="name" value="" class="d-block bg-dark" minlength="1" maxlength="50" required>
                    </div>

                    <!-- direccion -->
                    <div class="col">
                        <label for="" class="mText">address</label>
                        <input placeholder="cinema address" type="text" pattern="[A-Za-z0-9 ]+" title="Only letters and numbers" name="address" value="" class="d-block bg-dark" minlength="1" maxlength="100" required>
                    </div>                  

                    <!-- boton agregar cine -->
                    <div class="col">  
                        <label for="" class="mText">add new cinema</label>
                        <button type="submit" class="mBtn btn btn-outline-success px-5 py-1 text-white">ADD</button>                        
                    </div>                
                </div>
            </form>
            </div>
        </div>
    </section>
</main>