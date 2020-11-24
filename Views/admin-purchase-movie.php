<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="movieShowAdd">
        <div class="container">
        <div class="mt-2 rounded border border-primary border-bottom-0 p-1 transparentPanel">           
            <h1 class="mText text-white px-2 pt-4" style="font-size:3rem">Purchases by movies</h1>

            <form action="<?php echo FRONT_ROOT ?>Purchase/ShowAdminPurchasesMovieResults" method="post">            
                
                <div class="px-1 pb-3 row">

                    <!-- seleccionar pelicula -->
                    <div class="col-3 m-1">                    
                        <label for="" class="px-1 mText d-block">select movie</label>                        
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

                    <!-- seleccionar fecha -->
                    <div class="col">                        
                        <label class="px-1 mText d-block">from date</label>
                        <input required type="date" name="startDate" id="date" min="" max="" class="my-1 mdate">                                    
                    </div>                               

                    <div class="col">                    
                        <label class="px-1 mText d-block">to date</label>
                        <input required type="date" value="" name="endDate" id="dateTo" min="" max="" class="my-1 mdate">
                    </div>                                
                                    
                    <!-- boton agregar movie show -->
                    <div class="col p-0 m-0">  
                        <label for="" class="px-1 mText d-block">Select</label>
                        <button type="submit" class="mBtn text-white btn btn-outline-success my-1 px-3">SELECT</button>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </section>
</main>