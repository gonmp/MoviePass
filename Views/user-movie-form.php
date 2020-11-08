<?php
    require_once('nav.php');    
?>
<main>
    <section id="movieShowAdd">
        
        <h1 class="text-danger px-2 pt-4">Movie search</h1>

        <form action="<?php echo FRONT_ROOT ?>Movie/ShowResultMovieView" method="post">            
            
            <div class="px-1 pb-3 row">

                <!-- seleccionar genero -->
                <div class="col-3 m-1">                                                                                
                    <label for="" class="px-1 text-primary d-block">select genre</label>                    
                    <select name="categoryId" class="custom-select">                                                      
                        <!-- opciones de genero -->
                        <?php 
                            foreach($genresList as $genre)                                           
                            {?>
                              <option value="<?php echo $genre->GetIdGenre() ?>"><?php echo $genre->GetNameGenre()?></option>
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
                                
                <!-- boton buscar pelicula -->
                <div class="col-2 p-0">  
                    <label for="" class="px-1 text-primary d-block">search</label>
                    <button type="submit" class="btn btn-outline-danger text-white my-1 px-2">Search movie</button>
                </div>

                <!-- boton mostrar todas las peliculas -->
                <div class="col-4 ml-5 pl-5 p-0">                                          
                    <br>
                    <a href="<?php echo FRONT_ROOT . "Movie/ShowSearchMovieView"?>" class="float-right btn btn-outline-primary text-white mt-2 px-2">Get all movies</a>
                </div>
            </div>
        </form>
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>