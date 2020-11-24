<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="movieShowSelectRoom">
        <div class="container">        
            <div class="mt-2 rounded border border-primary border-bottom-0 p-1 transparentPanel">    
                <h2 class="mText" style="font-size:3rem">Select room</h2>

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
                        <button type="submit" class="mBtn text-white btn btn-outline-primary btn-sm px-4 mb-1 p-0">SELECT ROOM</button>
                    
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>





