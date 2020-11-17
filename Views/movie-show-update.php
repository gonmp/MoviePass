<?php
    require_once('checkAdmin.php');    
?>
<main>
    <section id="movieShowUpdate">
        
        <h1 class="text-danger px-2 pt-4">Modify Movie Show: <span class="text-white"><?php echo $movieShow->getId(); ?></span></h1>

        <form action="<?php echo FRONT_ROOT ?>MovieShow/Update" method="post">            
            
            <div class="px-1 pb-3 row m-0">

                <!-- id -->                
                <input type="hidden" name="id" value="<?php echo $movieShow->getId();?>"/>

                <!-- seleccionar pelicula -->
                <div class="col-3 m-1">                    
                    <label for="" class="px-1 text-primary d-block">movie</label>                        
                    <select class="custom-select" name="movieId">

                        <!-- opciones de peliculas desde la base de datos -->
                        <?php 
                            foreach($this->movieList as $movie)
                            {?>
                                <option                                     
                                    <?php if($movieShow->getMovie() == $movie) { ?> selected <?php } ?>
                                    value="<?php echo $movie->getId(); ?>"> 
                                    <?php echo $movie->getTitle(); ?> 
                                </option>                                                            
                            <?php                                                                                     
                            }                      
                        ?>                        
                    </select>
                </div>
                
                <!-- seleccionar cine -->
                <div class="col-3 m-1">                    
                    <label for="" class="px-1 text-primary d-block">cinema</label>                    
                    <select class="custom-select" name="cinemaId">
                                                
                        <!-- opciones de cines desde la base de datos -->
                        <?php 
                            foreach($this->cinemaList as $cinema)
                            {?>
                                <option                                     
                                    <?php if($movieShow->getCinema() == $cinema) { ?> selected <?php } ?>
                                    value="<?php echo $cinema->GetId(); ?>"> 
                                    <?php echo $cinema->GetName(); ?> 
                                </option>                                                                                            
                            <?php
                            }                      
                        ?>

                    </select>
                </div>

                <!-- seleccionar fecha -->
                <div class="col-2 p-0 m-1">                    
                    <label for="" class="px-1 text-primary d-block">date</label>                   
                    <input required type="date" name="movieShowDate" id="date" min="" max="" class="my-1 mdate"
                    value= <?php echo date_format($movieShow->getShowDate(),"Y-m-d");?>>
                </div>                

                <!-- seleccionar horario -->
                <div class="col-1 p-0 m-1 mr-3">                    
                    <label for="" class="px-1 text-primary d-block">select time</label>                    
                    <input required type="time" name="movieShowTime" value="<?php echo date_format($movieShow->getShowDate(), "H:i");?>" min="<?php echo Scripts\Utils::GetTime();?>" max="18" class="my-1">                    
                </div>                
                                
                <!-- boton update movie show -->
                <div class="col-1 p-0 ml-5">  
                    <label for="" class="px-1 text-primary d-block">modify show</label>
                    <button type="submit" class="btn btn-warning my-1 px-4">MODIFY</button>
                </div>

                <!-- boton cancelar -->
                <div class="col-1">
                        <label for="" class="px-1 text-danger d-block">go back</label>
                        <a href="<?php echo FRONT_ROOT . '/MovieShow/ShowAddMovieShow' ?>" class="btn btn-danger my-1 px-2">cancel operation</a>
                    </div>
            </div>

        </form>
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>