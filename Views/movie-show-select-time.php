<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="movieShowWizard">
        <div class="container">
            <h2 class="text-danger d-block">Select Time</h2>

            <div class="row p-0 m-0">    
                <form action="<?php echo FRONT_ROOT ?>MovieShow/Add" method="post">                                
                    
                    <!-- seleccionar fecha -->                      
                    <input type="time" name="movieTime" class="px-2" min="" max="" value="<?php echo Scripts\Utils::GetTime();?>">                    
                    
                    <!-- botones -->
                    <button type="submit" class="btn btn-primary btn-sm px-4 mb-1 p-0">SELECT TIME</button>           

                </form>
            </div>
        </div>        
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>





