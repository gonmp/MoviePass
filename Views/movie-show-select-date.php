<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="movieShowWizard">
        <div class="container">
            <h2 class="text-danger d-block">Select Date</h2>

            <div class="row p-0 m-0">    
                <form action="<?php echo FRONT_ROOT ?>MovieShow/SelectCinema" method="post">                                
                    
                    <!-- seleccionar fecha -->                      
                    <input type="date" name="movieDate" class="mdate" min="" max="" value="">                    
                    
                    <!-- botones -->
                    <button type="submit" class="btn btn-primary btn-sm px-4 mb-1 p-0">SELECT DATE</button>           

                </form>
            </div>
        </div>        
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>





