<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="movieShowSelectRoom">
        <div class="container">        
            <h2 class="text-danger">Select room</h2>

            <div class="row p-0 m-0">               
                <form action="<?php echo FRONT_ROOT ?>MovieShow/SelectTime" method="post">                                                
                    <select class="px-5" name="roomId">                                                    
                        <!-- opciones de cines desde la base de datos -->
                        <?php 
                            foreach($roomList as $room)
                            {
                                ?><option value="<?php echo $room->getId() ?>"><?php echo $room->getName()?></option>                            
                            <?php
                            }                      
                        ?>
                    </select>                                                                                     

                    <!-- botones -->
                    <button type="submit" class="btn btn-primary btn-sm px-4 mb-1 p-0">SELECT ROOM</button>
                
                </form>
            </div>
        </div>
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>





