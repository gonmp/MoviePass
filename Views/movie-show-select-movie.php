<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="movieShowSelectMovie">        
        <div class="container">                    
            <div class="mt-2 rounded border border-primary border-bottom-0 p-1 transparentPanel">                
                <h2 class="mText" style="font-size:3rem">Add Movie Show</h2>
                
                <div class="row p-0 m-0">                  
                    <form action="<?php echo FRONT_ROOT ?>MovieShow/SelectDate" method="post">                                                
                        <select name="movieId">
                            <?php
                                foreach($movieList as $movie)
                                {?>
                                    <option value="<?php echo $movie->getId();?>"
                                    <?php
                                    if ($movieSelected != null)
                                    {
                                        if ($movie->getId() == $movieSelected->getId())
                                        {?>
                                            selected
                                        <?php
                                        }
                                    }
                                    ?>
                                    >
                                        <?php echo $movie->getTitle(); ?>
                                        
                                    </option>
                                <?php
                                }
                            ?>                
                        </select>                                
                                        
                        <!-- botones -->
                        <button type="submit" class="mBtn text-white btn btn-outline-primary btn-sm px-3 mb-1 p-0">SELECT MOVIE</button>                
                </form>
            </div>
        </div>
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>