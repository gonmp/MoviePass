<?php
    require_once('nav.php');    
?>
<main>
    <section id="movieShowAdd">        
        <div class="container">                    
            <div class="mt-5 pb-2 transparentPanel border border-secondary border-bottom-0 rounded">            
                
            <!-- movie search -->
                <div class="row m-0 p-0">                        
                    <div class="col">
                        <h1 class="mTitle">Movie search</h1>                
                    </div>
                </div>

                <!-- filtered by -->
                <form action="<?php echo FRONT_ROOT ?>Movie/ShowResultMovieView" method="post">     
                    <div class="row m-0 p-0">

                        <!-- seleccionar genero -->                    
                        <div class="col">
                            <label class="mText d-block">select genre</label>                    
                            <select name="categoryId" class="custom-select">                        
                                <!-- opciones de genero -->
                                <option value="all" selected>All genres</option>
                                <?php 
                                    foreach($genresList as $genre)                                           
                                    {?>
                                        <option value="<?php echo $genre->GetIdGenre() ?>"><?php echo $genre->GetNameGenre()?></option>
                                    <?php
                                    }?>
                            </select>                     
                        </div>

                        <!-- seleccionar fecha de inicio -->
                        <div class="col">                        
                            <label class="mText d-block">from date</label>
                            <input required type="date" name="startDate" id="date" min="" max="" class="mdate">                                    
                        </div>

                        <!-- seleccionar fecha de final -->
                        <div class="col">                    
                            <label class="mText d-block">to date</label>
                            <input required type="date" value="" name="endDate" id="dateTo" min="" max="" class="mdate">
                        </div>     

                        <!-- botones -->
                        <div class="col btn-group">
                            
                            <!-- boton buscar pelicula -->
                            <div class="">  
                                <label for="" class="mText d-block">search</label>
                                <button type="submit" class="btn btn-outline-danger mBtn">Search movie</button>
                            </div>                

                            <!-- boton mostrar todas los estrenos -->
                            <div class="">
                                <label for="" class="mText d-block">all premieres</label>
                                <a href="<?php echo FRONT_ROOT . "Movie/ShowAllMoviesPremieres"?>" class="btn btn-outline-primary mBtn">Get all premieres</a>
                            </div>

                            <!-- boton mostrar todas las peliculas -->
                            <div class="">
                                <label for="" class="mText d-block">all movies</label>
                                <a href="<?php echo FRONT_ROOT . "Movie/ShowAllMovies"?>" class="btn btn-outline-danger mBtn">Get all movies</a>
                            </div>                              

                        </div>                
                    </form>                    
                </div>    
            </div>
        </div>
    </section>    
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>