<?php
    require_once(VIEWS_PATH.'nav.php');
?>

<div class="container-fluid">                         
    <div class="row">

        <!-- imagen -->    
        <div class="col-3">            
            <img class="img-thumbnail img-responsive" src="https://image.tmdb.org/t/p/w500/<?php echo $movie->getposter_path()?>" alt="<?php echo $movie->getTitle();?>">    
        </div>

        <!-- detalles -->
        <div class="col-5">                                
            <!-- titulo -->
            <div class="w-75 text-justify">
                <p class="h4 mr-4 d-inline text-danger">Title: </p>                
                <span class="h4 d-inline text-center text-primary m-0 mb-2"><?php echo $movie->getTitle();?></span>    
            </div>
        
            <!-- generos -->                                 
            <div class="mt-3 w-75 text-justify">                                
                <p class="h5 mr-3 d-inline text-danger">Genres: </p>
                <span class="text-white"><?php
                foreach($movie->getGenres() as $genre) 
                { 
                    echo $genre->GetNameGenre() . ". ";  
                }?>
                </span>                                     
            </div>

            <!-- descripcion -->
            <div class="mt-3 w-75 text-justify">
                <p class="h5 mr-3 d-inline text-danger">Overview: </p>
                <span class="h7 d-inline text-white m-0 mb-2"><?php echo $movie->getOverview();?></span>    
            </div>            

            <!-- boton comprar -->
            <div class="m-0 mt-3 float-left">
                <a href="#" class="btn btn-sm btn-outline-danger text-white">buy ticket</a>
            </div>

            <!-- boton volver a lista de peliculas -->
            <div class="m-2 ml-4 mt-3 float-left">
                <a href="<?php echo FRONT_ROOT?>/Movie/ShowAllMoviesPremieres" class="btn btn-sm btn-outline-primary text-white">back to movie list</a>
            </div>
        </div>

    <!-- cines donde se esta proyectando -->
    <div class="mx-3 mt-2 w-100 text-justify">
            <p class="h2 mr-3 d-inline text-danger">Cinemas where you can see it</p>                
            
            <table class="mt-3 table table-sm">
                <thead class="">
                    <tr>
                        <th scope="col" class="text-primary">cinema</th>                        
                        <th scope="col" class="text-primary">address</th> 
                        <th scope="col" class="text-primary">date</th>
                        <th scope="col" class="text-primary">time</th>
                        <th scope="col" class="text-primary">ticket value</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <?php                    
                    foreach($movieShowList as $movieShow)
                    {?>
                        <tr>
                            <th class="text-danger"><?php echo $movieShow->getCinema()->getName();?></td>
                            <td><?php echo $movieShow->getCinema()->getAddress();?></td>
                            <td><?php echo $movieShow->getShowDate()->format('d-m-Y');?></td>
                            <td><?php echo $movieShow->getShowDate()->format('H : i');?></td>
                            <td><?php echo $movieShow->getCinema()->getTicketValue();?></td>                            
                        </tr>                        
                    <?php
                    }?>                        
                </tbody>
            </table>
        </div>
    </div>
</div>   