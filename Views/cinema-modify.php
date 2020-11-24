<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="cinemaModify">        
        <div class="container">
            <div class="row m-0 p-2 mt-1 border border-primary border-bottom-0 rounded transparentPanel">
                <h1 class="text-white mText" style="font-size:3em">Modifying Cinema: <span class="text-danger" style="font-size: 4rem"><?php echo $cinema->getId();?></span></h1>

                <form action="<?php echo FRONT_ROOT ?>Cinema/Update" method="post">           
                    
                    <div class="row pb-2">

                        <!-- id -->                
                        <input type="hidden" name="id" value="<?php echo $cinema->getId();?>"/>                    

                        <!-- nuevo nombre -->                
                        <div class="col">
                            <label for="" class="mText">name</label>                                                              
                            <input type="text" pattern="[A-Za-z0-9 ]+" title="only letters and numbers" name="name" value="<?php echo $cinema->getName();?>" class="d-block bg-dark text-white" minlength="1" maxlength="50" required>
                        </div>        
                        
                        <!-- direccion -->
                        <div class="col">
                            <label for="" class="mText">address</label>
                            <input type="text" pattern="[A-Za-z0-9 ]+" title="Only letters and numbers" name="address" value="<?php echo $cinema->getAddress();?>" class="d-block bg-dark text-white" minlength="1" maxlength="100" required>
                        </div>          
                        
                        <!-- botones -->
                        <div class="btn-group">                  
                            <!-- boton agregar cine -->
                            <div class="col">
                                <label for="" class="mText d-block">modify</label>
                                <button type="submit" class="mBtn btn btn-outline-warning btn-sm px-5 mb-1 text-white">MODIFY CINEMA</button>
                            </div>                    
                            
                            <!-- boton cancelar -->
                            <div class="col">
                                <label for="" class="mText d-block">go back</label>
                                <a href="<?php echo FRONT_ROOT . '/Cinema/ShowAddView' ?>" class="btn btn-outline-danger btn-sm px-5 mb-1 text-white mBtn">GO BACK</a>
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
        </div>
    </section>
</main>