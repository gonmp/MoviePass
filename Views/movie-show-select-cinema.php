<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="movieShowSelectCinema">
        <div class="container">            
            <div class="mt-2 rounded border border-primary border-bottom-0 p-1 transparentPanel">    
                <h2 class="mText" style="font-size:3rem">Select Cinema</h2>
                
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
                                    <option value="<?php echo $cinema->getName();?>"
                                    <?php if($selectedCinema != null)
                                    {
                                        if ($cinema->getName() == $selectedCinema)
                                        {?>
                                            selected
                                        <?php
                                        }
                                    }
                                    ?>
                                    >
                                        <?php echo $cinema->getName()?>
                                    </option>
                                <?php
                                }
                            ?>
                        </select>

                        <!-- botones -->
                        <button type="submit" class="mBtn text-white btn btn-outline-primary btn-sm px-4 mb-1 p-0">SELECT CINEMA</button>                                       
                    </form>                
                </div>
            </div>
        </div>
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>





