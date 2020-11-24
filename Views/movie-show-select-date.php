<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="movieShowWizard">
        <div class="container">
            <div class="mt-2 rounded border border-primary border-bottom-0 p-1 transparentPanel">    
                <h2 class="mText d-block" style="font-size: 3rem">Select Date</h2>

                <div class="row p-0 m-0">    
                    <form action="<?php echo FRONT_ROOT ?>MovieShow/SelectCinema" method="post">                                
                        
                        <!-- seleccionar fecha -->                      
                        <input id="updateDate" class="mdate" required type="date" name="movieDate" min="" max="" 
                        value=
                        <?php  
                            if ($dateSelected != null)
                            {
                                echo date_format($auxMovieShow->getShowDate(),"Y-m-d");                        
                            }
                        ?>
                        >                    

                        <!-- botones -->
                        <button type="submit" class="mBtn btn text-white btn-outline-primary btn-sm px-4 mb-1 p-0">SELECT DATE</button>           

                    </form>
                </div>
            </div>        
        </div>
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>





