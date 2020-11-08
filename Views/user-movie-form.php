<?php
    require_once('nav.php');    
?>
<main>
    <section id="movieShowAdd">        
        <h1 class="text-danger px-2 pt-4">Movie search</h1>
        <form action="<?php echo FRONT_ROOT ?>Movie/ShowResultMovieView" method="post">                        
            <div class="px-1 pb-3 row">

                <!-- seleccionar genero -->
                <div class="col m-1">                                                                                
                    <label for="" class="px-1 text-primary">select genre</label>                    
                    <select name="categoryId" class="custom-select">                                                      
                        
                        <!-- opciones de genero -->
                        <option value="all" selected>All genres</option>
                        <?php 
                            foreach($genresList as $genre)                                           
                            {?>
                              <option value="<?php echo $genre->GetIdGenre() ?>"><?php echo $genre->GetNameGenre()?></option>
                            <?php
                            }                      
                        ?>
                    </select>
                </div>                

                <!-- seleccionar fecha de inicio -->
                <div class="col m-1">                    
                    <label for="" class="px-1 text-primary">from date</label>
                    <input required type="date" name="startDate" id="date" min="" max="" class="my-1">
                </div>                

                <!-- seleccionar fecha de final -->
                <div class="col m-1">                    
                    <label for="" class="px-1 text-primary">to date</label>
                    <input required type="date" name="endDate" id="date" min="" max="" class="my-1">
                </div>                
                                
                <!-- boton buscar pelicula -->
                <div class="col p-0">  
                    <label for="" class="d-block px-1 text-primary">search</label>
                    <button type="submit" class="btn btn-outline-danger text-white my-1 px-2">Search movie</button>
                </div>                

                <!-- boton mostrar todas los estrenos -->
                <div class="col">
                    <label for="" class="d-block px-2 mb-2 text-primary">all premieres</label>
                    <a href="<?php echo FRONT_ROOT . "Movie/ShowAllMoviesPremieres"?>" class="btn btn-outline-primary text-white px-2">Get all premieres</a>
                </div>

                <!-- boton mostrar todas las peliculas -->
                <div class="col">
                    <label for="" class="d-block px-2 mb-2 text-primary">all movies</label>
                    <a href="<?php echo FRONT_ROOT . "Movie/ShowAllMovies"?>" class="btn btn-outline-danger text-white px-2">Get all movies</a>
                </div>
            </div>
        </form>        
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>