<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="cinemaModify">
        
        <h1 class="text-danger px-2 pt-4">Modifying Cinema: <span class="text-white"><?php echo $cinema->getId();?></span></h1>

        <form action="<?php echo FRONT_ROOT ?>Cinema/Update" method="post">           
            
            <div class="row px-1 pb-3">

                <!-- id -->                
                <input type="hidden" name="id" value="<?php echo $cinema->getId();?>"/>

                <!-- nombre anterior -->                
                <input type="hidden" name="oldName" value="<?php echo $cinema->getName();?>"/>

                <!-- nuevo nombre -->                
                <div class="col m-1">
                    <label for="" class="text-primary">name</label>                                                              
                    <input type="text" pattern="[A-Za-z0-9 ]+" title="only letters and numbers" name="name" value="<?php echo $cinema->getName();?>" class="form-control" minlength="1" maxlength="50" required>
                </div>        
                
                <!-- direccion -->
                <div class="col m-1">
                    <label for="" class="text-primary">address</label>
                    <input type="text" pattern="[A-Za-z0-9 ]+" title="Only letters and numbers" name="address" value="<?php echo $cinema->getAddress();?>" class="form-control" minlength="1" maxlength="100" required>
                </div>          
                
                <!-- botones -->
                <div class="col-3 p-0">                  
                    <!-- boton agregar cine -->
                    <div class="d-inline float-left">
                        <label for="" class="px-1 text-primary d-block">modify</label>
                        <button type="submit" class="btn btn-warning my-1 px-2">modify cinema</button>
                    </div>                    
                    
                    <!-- boton cancelar -->
                    <div class="d-inline float-left mx-2">
                        <label for="" class="px-1 text-danger d-block">go back</label>
                        <a href="<?php echo FRONT_ROOT . '/Cinema/ShowAddView' ?>" class="btn btn-danger my-1 px-2">cancel operation</a>
                    </div>
                </div>

            </div>
            

            <!-- error -->
            <?php
            if ($_SESSION['cinemaError'] != null)
            {?>            
                <div class="row">
                    <p class="ml-4 text-warning"><?php echo $_SESSION['cinemaError']?></p>
                </div>            
            <?php
            }?>                    

        </form>
    </section>
</main>