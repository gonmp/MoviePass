<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="movieShowSelectMovie">        
        <div class="container">                               
            
            <div class="row p-0 m-0">                  
                <form action="<?php echo FRONT_ROOT ?>MovieShow/ValidateUpdateMovie" method="post">                                                

                    <input hidden name="movieShowId" value="<?php echo $movieShow->getId(); ?>">

                    <select name="movieId">
                        <?php
                            foreach($movieList as $thisMovie)
                            {?>
                                <option value="<?php echo $thisMovie->getId();?>"
                                <?php
                                if ($thisMovie->getId() == $movie->getId())
                                {?>
                                    selected
                                <?php
                                }
                                ?>                               
                                >
                                    <?php echo $thisMovie->getTitle(); ?>
                                </option>
                            <?php
                            }
                        ?>                
                    </select>                                
                                    
                    <!-- botones -->
                    <button type="submit" class="btn btn-warning btn-sm px-4 p-0">UPDATE MOVIE</button>   

                    <!-- boton volver -->                  
                    <a href="<?php echo FRONT_ROOT . 'MovieShow\ShowAddMovieShow'?>"  class="btn btn-sm btn-danger text-white px-5 p-0">BACK</a>             
            </form>
        </div>
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>