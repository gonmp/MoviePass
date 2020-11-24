<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="cinemaModify">        
        <div class="container">

            <h1 class="text-danger">Modifying Cinema: <span class="text-white"><?php echo $cinema->getId();?></span></h1>

            <form action="<?php echo FRONT_ROOT ?>Cinema/Update" method="post">           
                
                <div class="row pb-2">

                    <!-- id -->                
                    <input type="hidden" name="id" value="<?php echo $cinema->getId();?>"/>                    

                    <!-- nuevo nombre -->                
                    <div class="col">
                        <label for="" class="text-primary">name</label>                                                              
                        <input type="text" pattern="[A-Za-z0-9 ]+" title="only letters and numbers" name="name" value="<?php echo $cinema->getName();?>" class="form-control" minlength="1" maxlength="50" required>
                    </div>        
                    
                    <!-- direccion -->
                    <div class="col">
                        <label for="" class="text-primary">address</label>
                        <input type="text" pattern="[A-Za-z0-9 ]+" title="Only letters and numbers" name="address" value="<?php echo $cinema->getAddress();?>" class="form-control" minlength="1" maxlength="100" required>
                    </div>          
                    
                    <!-- botones -->
                    <div class="btn-group">                  
                        <!-- boton agregar cine -->
                        <div class="col">
                            <label for="" class="text-warning d-block">modify</label>
                            <button type="submit" class="btn btn-warning btn-sm px-5 mb-1">MODIFY CINEMA</button>
                        </div>                    
                        
                        <!-- boton cancelar -->
                        <div class="col">
                            <label for="" class="text-danger d-block">go back</label>
                            <a href="<?php echo FRONT_ROOT . '/Cinema/ShowAddView' ?>" class="btn btn-danger btn-sm px-5 mb-1 text-white">GO BACK</a>
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
        </div>
    </section>
</main>