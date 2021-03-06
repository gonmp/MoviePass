<main>
     <section id="movieShowResult">
          <div class="container">            
          <div class="row justify-content-center">
               <?php                    
                    $auxMovieList = array();                                        
                    foreach($list as $movieShow)
                    {    
                         if (in_array($movieShow->getMovie()->getId(), $auxMovieList) == false)
                         {?>                                        
                              <div class="card d-inline-block m-1 border border-primary p-2 border-bottom-0 rounded" style="width: 11rem; background-color:black">                         
                                   
                                   <!-- imagen con link al detalle de la pelicula -->
                                   <a href="<?php echo FRONT_ROOT?>/Movie/ShowMovieDetails?movieId=<?php echo $movieShow->getMovie()->getId()?>">
                                   <img class="card-img-top" src="https://image.tmdb.org/t/p/w500/<?php echo $movieShow->getMovie()->getposter_path()?>" alt="<?php echo $movieShow->getMovie()->getTitle();?>">
                                   </a>
                                   
                                   <!-- titulo -->
                                   <strong class="card-title mText"><?php echo $movieShow->getMovie()->getTitle();?></strong>                         
                                   
                                   <!-- generos -->                         
                                   <div class="card-text">                                                                      
                                        <span class="text-white"><?php
                                        foreach($movieShow->getMovie()->getGenres() as $genre) 
                                        { 
                                             echo $genre->GetNameGenre() . ". ";
                                        }?>
                                        
                                        </span>                         
                                   </div>
                              </div>                    
                         <?php
                              array_push($auxMovieList, $movieShow->getMovie()->getId());                         
                         }?>
                    <?php                          
                    }
               ?>        
               </div>                                                               
        </div>
    </section>
</main>