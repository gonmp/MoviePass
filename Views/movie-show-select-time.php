<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="movieShowWizard">
        <div class="container">
            <div class="mt-2 rounded border border-primary border-bottom-0 p-1 transparentPanel">    
                <h2 class="mText d-block" style="font-size:3rem">Select Time</h2>

                <div class="row p-0 m-0">    
                    <form action="<?php echo FRONT_ROOT ?>MovieShow/Add" method="post">                                
                        
                        <!-- seleccionar fecha -->                      
                        <input type="time" name="movieTime" class="px-2" min="" max="" 
                        value=
                        <?php 
                            if ($timeSelected != null)
                            {
                                echo $timeSelected;
                            } 
                            else
                            {
                                echo Scripts\Utils::GetTime();
                            }
                        ?>                    
                        >                    
                        
                        <!-- botones -->
                        <button type="submit" class="mBtn text-white btn btn-outline-primary btn-sm px-4 mb-1 p-0">SELECT TIME</button>           

                    </form>
                </div>
            </div>
        </div>        
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>





