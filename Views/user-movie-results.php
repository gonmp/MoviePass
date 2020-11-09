<main>
     <section id="movieShowResult">
          <div class="container-fluid m-0 mt-4 p-0">            
               <?php                    
                    $movieName = null;
                    foreach($list as $movieShow)
                    {
                         if ($movieShow->getMovie()->getTitle() != $movieName)
                         {
                              $movieName = $movieShow->getMovie()->getTitle();              
                         ?>                                        
                              <div class="col-2 float-left" style="height: 26rem;">                              

                                   <!-- imagen con link al detalle de la pelicula -->
                                   <a href="<?php echo FRONT_ROOT?>/Movie/ShowMovieDetails?movieId=<?php echo $movieShow->getMovie()->getId()?>">
                                   <img class="img-thumbnail img-responsive" src="https://image.tmdb.org/t/p/w500/<?php echo $movieShow->getMovie()->getposter_path()?>" alt="<?php echo $movieShow->getMovie()->getTitle();?>">
                                   </a>

                                   <!-- titulo -->
                                   <strong class="d-block text-center text-primary m-0 mt-2 mb-2"><?php echo $movieShow->getMovie()->getTitle();?></strong>                         

                                   <!-- generos -->                         
                                   <div class="text-left">                              
                                        <p class="d-inline text-danger">genres: </p>
                                        <span class="text-white"><?php
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
    </section>
</main>