<?php
    //require_once('checkAdmin.php');
?>
<main>
    <section id="roomAdd">
        
        <h1 class="text-danger px-2 pt-4">Add Room to <?php echo $cinema->getName(); ?></h1>

        <form action="<?php echo FRONT_ROOT ?>Room/Add" method="post">                        
            <div class="px-1 pb-3 row">

                <input type="text" hidden name="cinemaName" value="<?php echo $cinema->getName();?>">

                <!-- seleccionar capacidad  -->
                <div class="col-2 p-0 m-1 mr-3">                    
                    <label for="" class="px-1 text-primary d-block">select capacity</label>                    
                    <input required type="number" name="capacity" min="1" max="" value="0" class="my-1">                    
                </div>                                

                <!-- seleccionar valor del ticket -->
                <div class="col-2 p-0 m-1 mr-3">                    
                    <label for="" class="px-1 text-primary d-block">select ticket value</label>                    
                    <input required type="number" name="ticketValue" value="0" min="1" max="" class="my-1">                    
                </div>                         

                <!-- seleccionar nombre -->
                <div class="col-2 p-0 m-1 mr-3">                    
                    <label for="" class="px-1 text-primary d-block">room's name</label>                    
                    <input required type="text" name="name" placeholder="room's name" min="1" max="" class="my-1" minlength="1" maxlength="20" pattern="[A-Za-z0-9 ]+" title="only letters and numbers">                    
                </div>                         

                                
                <!-- boton agregar room -->
                <div class="col-2 p-0 m-0 ml-4">  
                    <label for="" class="px-1 text-primary d-block">add room</label>
                    <button type="submit" class="btn btn-success my-1 px-5">ADD</button>
                </div>
            </div>

        </form>
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>





