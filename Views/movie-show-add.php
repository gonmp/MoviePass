<?php
    require_once('nav.php');
?>
<main>
    <section id="movieShowAdd">
        
        <h1 class="text-danger px-2 pt-4">Add Movie Show</h1>

        <form action="<?php echo FRONT_ROOT ?>MovieShow/Add" method="post">            
            
            <div class="px-1 pb-3 row">

                <!-- seleccionar pelicula -->
                <div class="col-3 m-1">                    
                    <label for="" class="px-1 text-primary d-block">select movie</label>
                    <select class="custom-select">

                        <!-- opciones de peliculas desde la base de datos -->
                        <?php 

                        ?>
                    </select>
                </div>
                <!-- seleccionar cine -->
                <div class="col-3 m-1">                    
                    <label for="" class="px-1 text-primary d-block">select cinema</label>                    
                    <select class="custom-select">
                                                
                        <!-- opciones de cines desde la base de datos -->
                        <?php 
                            foreach($this->cinemaList as $cinema)
                            {
                                ?><option value="<?php $cinema ?>"><?php echo $cinema->GetName()?></option>                            
                            <?php
                            }                      
                        ?>

                    </select>
                </div>

                <!-- seleccionar fecha -->
                <div class="col-2 m-1">                    
                    <label for="" class="px-1 text-primary d-block">select date</label>
                    <input type="date" class="my-1">
                </div>                
                                
                <!-- boton agregar movie show -->
                <div class="col-2 p-0">  
                    <label for="" class="px-1 text-primary d-block">add movie show</label>
                    <button type="submit" class="btn btn-success my-1 px-2">add this movie show</button>
                </div>
            </div>

        </form>

    </section>
</main>




