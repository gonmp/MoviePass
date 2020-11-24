<?php
    require_once('checkAdmin.php');    
?>
<main>
    <section id="movieShowUpdate">
        <div class="container">
            <h2 class="text-danger">Modifying Movie Show: <span class="text-white"><?php echo $movieShow->getId(); ?></span></h2>

            <form action="<?php echo FRONT_ROOT ?>MovieShow/Update" method="post">                            
                
                <!-- id -->                      
                <input type="hidden" name="id" value="<?php echo $movieShow->getId();?>"/>                        

                <div class="row">
                    <div class="col">
                        <!-- movie -->
                        <label class="text-primary d-block">Movie</label>
                        <select name="movieId">
                            <?php
                                foreach($movieList as $movie)
                                {?>
                                    <option value="<?php echo $movie->getId();?>" 
                                    <?php 
                                        if ($movie->getId() == $movieShow->getMovie()->getId())
                                        {?>
                                        selected 
                                        <?php
                                        }?>
                                    >
                                    <?php echo $movie->getTitle(); ?>
                                    </option>
                                <?php
                                }
                            ?>                
                        </select>  
                    </div>

                    <!-- cinema -->
                    <div class="col">
                        <label class="text-primary d-block">Cinema</label>
                        <select name="cinemaName">
                            <?php 
                                foreach($cinemaList as $cinema)
                                {?>
                                    <option value="<?php echo $cinema->getName();?>">
                                        <?php echo $cinema->getName()?>
                                    </option>
                                <?php
                                }
                                ?>
                        </select>
                    </div>
                    
                    <!-- room -->
                    <div class="col">
                        <label class="text-primary d-block">Room</label>
                        <select name="roomId">                                                    
                            <!-- opciones de cines desde la base de datos -->
                            <?php 
                                foreach($roomList as $room)
                                {
                                    ?><option value="<?php echo $room->getId() ?>"><?php echo $room->getName()?></option>                            
                                <?php
                                }                      
                            ?>
                        </select>    
                    </div>

                    <!-- date -->

                    <!-- time -->

                    <!-- buttons -->

                        <!-- modify -->

                        <!-- cancel -->
                </div>
            </form>
        </div>
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>