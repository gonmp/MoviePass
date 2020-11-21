<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="movieShowSelectCinema">
        <div class="container">            
            <h2 class="text-danger">Select Cinema</h2>
            
            <div class="row p-0 m-0">            
                <form action="<?php echo FRONT_ROOT ?>MovieShow/SelectRoom" method="post">            

                <?php 
                    if ($textoToAdmin != null) 
                    {?>
                        <p class="text-warning h6"><?php echo $textoToAdmin;?></p>
                    <?php
                    }
                ?>
                    <select class="px-5" name="cinemaName">
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

                    <!-- botones -->
                    <button type="submit" class="btn btn-primary btn-sm px-4 mb-1 p-0">SELECT CINEMA</button>                                       
                </form>                
            </div>
        </div>
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>





