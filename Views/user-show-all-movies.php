<main>
     <section id="showAllMovies">
          <div class="container-fluid m-0 mt-4 p-0">            
               <?php                    
                    $movieName = null;
                    foreach($list as $movie)
                    {
                         if ($movie->getTitle() != $movieName)
                         {
                              $movieName = $movie->getTitle();              
                         ?>                                        
                              <div class="col-2 float-left" style="height: 26rem;">                              

                                   <!-- imagen -->
                                   <a href="<?php echo FRONT_ROOT?>/Movie/ShowMovieDetails?movieId=<?php echo $movie->getId()?>">
                                   <img class="img-thumbnail img-responsive" src="https://image.tmdb.org/t/p/w500/<?php echo $movie->getposter_path()?>" alt="<?php echo $movie->getTitle();?>">
                                   </a>

                                   <!-- titulo -->
                                   <strong class="d-block text-center text-primary m-0 mt-2 mb-2"><?php echo $movie->getTitle();?></strong>                         

                                   <!-- generos -->                         
                                   <div class="text-left">                              
                                        <p class="d-inline text-danger">genres: </p>
                                        <span class="text-white"><?php
                                        foreach($movie->getGenres() as $genre) 
                                        { 
                                             echo $genre->GetNameGenre() . ". ";
                                        }?>
                                        </span>                         
                                   </div>
                              </div>                    
                         <?php
                         }?>
                    <?php                          
                    }
               ?>                                                                       
        </div>
    </section>
</main>