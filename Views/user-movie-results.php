<main>
     <section id="movieShowResult">
          <div class="container">            
          <div class="row justify-content-center">
               <?php                    
                    $movieName = null;
                    foreach($list as $movieShow)
                    {
                         if ($movieShow->getMovie()->getTitle() != $movieName)
                         {
                              $movieName = $movieShow->getMovie()->getTitle();              
                         ?>                                        
                              <div class="card d-inline-block m-1" style="width: 9rem;">                         

                                   <!-- imagen con link al detalle de la pelicula -->
                                   <a href="<?php echo FRONT_ROOT?>/Movie/ShowMovieDetails?movieId=<?php echo $movieShow->getMovie()->getId()?>">
                                   <img class="card-img-top" src="https://image.tmdb.org/t/p/w500/<?php echo $movieShow->getMovie()->getposter_path()?>" alt="<?php echo $movieShow->getMovie()->getTitle();?>">
                                   </a>

                                   <!-- titulo -->
                                   <strong class="card-title"><?php echo $movieShow->getMovie()->getTitle();?></strong>                         

                                   <!-- generos -->                         
                                   <div class="card-text">                              
                                        <p class="d-inline text-danger">genres: </p>
                                        <span class="text-dark"><?php
                                        foreach($movieShow->getMovie()->getGenres() as $genre) 
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