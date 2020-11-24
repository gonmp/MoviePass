<main>
     <section id="showAllMovies">
          <div class="container">            
          <div class="row justify-content-center">
               <?php                    
                    $movieName = null;
                    foreach($list as $movie)
                    {
                         if ($movie->getTitle() != $movieName)
                         {
                              $movieName = $movie->getTitle();              
                         ?>                                        
                              <div class="card d-inline-block m-1" style="width: 9rem;">
                                   
                                   <!-- imagen -->
                                   <a href="<?php echo FRONT_ROOT?>/Movie/ShowMovieDetails?movieId=<?php echo $movie->getId()?>">
                                   <img class="card-img-top" src="https://image.tmdb.org/t/p/w500/<?php echo $movie->getposter_path()?>" alt="<?php echo $movie->getTitle();?>">
                                   </a>

                                   <!-- titulo -->
                                   <strong class="card-title"><?php echo $movie->getTitle();?></strong>                         

                                   <!-- generos -->                         
                                   <div class="card-text">                              
                                        <p class="d-inline text-danger">genres: </p>
                                        <span class="text-dark"><?php
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
        </div>
    </section>
</main>