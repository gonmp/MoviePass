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
                              <div class="card d-inline-block m-1 border border-primary p-2 border-bottom-0 rounded" style="width: 9rem; background-color:black">
                                   
                                   <!-- imagen -->
                                   <a href="<?php echo FRONT_ROOT?>/Movie/ShowMovieDetails?movieId=<?php echo $movie->getId()?>">
                                   <img class="card-img-top" src="https://image.tmdb.org/t/p/w500/<?php echo $movie->getposter_path()?>" alt="<?php echo $movie->getTitle();?>">
                                   </a>

                                   <!-- titulo -->
                                   <strong class="card-title mText"><?php echo $movie->getTitle();?></strong>                         

                                   <!-- generos -->                         
                                   <div class="card-text">                                                                      
                                        <span class="text-white" style="font-size:0.9rem;"><?php
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