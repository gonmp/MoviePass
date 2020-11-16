<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="movieShowSelectMovie">
        
        <h1 class="text-danger px-2 pt-4">Select Movie</h1>

        <form action="<?php echo FRONT_ROOT ?>MovieShow/SelectDate" method="post">                        
            <div class="px-1 pb-3 row">               

                <!-- room id -->
                <intput hidden>

                <!-- seleccionar pelicula -->
                <div class="col-3 m-1">                    
                    <label for="" class="px-1 text-primary d-block">select movie</label>                        
                    <select class="custom-select" name="movieId">

                        <!-- opciones de peliculas desde la base de datos -->
                        <?php 
                            foreach($this->movieList as $movie)
                            {                             
                                ?><option value="<?php echo $movie->getId(); ?>"> <?php echo $movie->getTitle(); ?> </option>                            
                            <?php
                            }                      
                        ?>
                    </select>
                </div>
                                
                <!-- boton continuar -->
                <div class="col-2 p-0 m-0 ml-4">  
                    <label for="" class="px-1 text-primary d-block">continue</label>
                    <button type="submit" class="btn btn-success my-1 px-5">NEXT</button>
                </div>
            </div>

        </form>
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>





