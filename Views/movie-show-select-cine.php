<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="movieShowSelectCinema">
        <div class="container">
            <div class="row m-0">

                <div class="col border">
                
                    <h1 class="text-danger">Select Cinema</h1>
                    <form action="<?php echo FRONT_ROOT ?>MovieShow/SelectRoom" method="post">            

                        <!-- seleccionar cine -->
                        <div class="col float-left w-50">                    
                            <label for="" class="text-primary d-block">select cinema</label>                    
                            <select class="custom-select" name="cinemaName">
                                                                
                                <!-- opciones de cines desde la base de datos -->
                                <?php 
                                    foreach($this->cinemaList as $cinema)
                                    {
                                        ?><option value="<?php echo $cinema->getName() ?>"><?php echo $cinema->getName()?></option><?php
                                    }                      
                                    ?>
                            </select>
                        </div>

                    <!-- botones -->
                    <div class="btn-group">
                        <!-- boton continuar -->
                        <div class="col">  
                            <label for="" class="text-success d-block">continue</label>
                            <button type="submit" class="btn btn-success px-5">NEXT</button>
                        </div>

                        <!-- boton cancelar -->
                        <div class="col">  
                            <label for="" class="text-danger d-block">cancel</label>
                            <a href="<?php echo FRONT_ROOT . "AdminManager/ShowAddMovieShowView"?>" class="btn btn-danger text-white px-5">CANCEL</a>
                        </div>
                    </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>





