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

            <!-- cines donde se esta proyectando -->
            <div class="mt-3 w-75 text-justify">
                <p class="h5 mr-3 d-inline text-danger">Cinemas where you can see it</p>
                
                <p class="text-primary">Cinema 1: <span class="text-white"> 12/05 - 12:30</span><span class="btn btn-sm btn-outline-danger text-white">buy a ticket</span></p>
                <p class="text-primary">Cinema 2: <span class="text-white"> 12/05 - 22:45</span><span class="btn btn-sm btn-outline-danger text-white">buy a ticket</span></p>
                <p class="text-primary">Cinema 3: <span class="text-white"> 12/05 - 11:00</span><span class="btn btn-sm btn-outline-danger text-white">buy a ticket</span></p>                                
            </div>

        </div>
    </div>
</div>   