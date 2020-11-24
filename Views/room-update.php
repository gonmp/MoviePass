<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="roomAdd">
    <div class="container">
        
        <h1 class="text-danger">Modifying Room id: <span class="text-white"><?php echo $room->getId();?></span></h1>

        <form action="<?php echo FRONT_ROOT ?>Room/Update" method="post">            
            
            <div class="row">               

                <!-- id -->
                <input hidden name="roomId" value="<?php echo $room->getId();?>">                

                <!-- cinema -->
                <input hidden name="cinemaName" value="<?php echo $room->getCinema()->getName();?>">                

                <!-- seleccionar nombre -->
                <div class="col">                    
                    <label for="" class="text-primary d-block">room's name</label>                    
                    <input required type="text" value="<?php echo $room->getName()?>" name="name" placeholder="room's name" min="1" max="" class="my-1" minlength="1" maxlength="20" pattern="[A-Za-z0-9 ]+" title="only letters and numbers">                    
                </div>                         
                
                <!-- seleccionar capacidad  -->
                <div class="col">                    
                    <label for="" class=" text-primary d-block">select capacity</label>                    
                    <input required type="number" value="<?php echo $room->getCapacity()?>" name="capacity" min="1" max="" value="0" class="my-1">                    
                </div>                                

                <!-- seleccionar valor del ticket -->
                <div class="col">                    
                    <label for="" class="text-primary d-block">select ticket value</label>                    
                    <input required type="number" value="<?php echo $room->getTicketValue()?>" name="ticketValue" value="0" min="1" max="" class="my-1">                    
                </div>                         

                                
                <!-- boton modificar -->
                <div class="btn-group">                
                    <div class="col">  
                        <label for="" class="text-warning d-block">modify</label>
                        <button type="submit" class="btn btn-warning btn-sm px-5 mb-1">MODIFY ROOM</button>
                    </div>

                    <div class="col">  
                        <label for="" class="text-danger d-block">go back</label>
                        <a href="<?php echo FRONT_ROOT . '/Room/ShowAddRoom?cinemaName=' . $room->getCinema()->getName();?>" class="btn btn-danger btn-sm px-5 mb-1 text-white">GO BACK</a>
                    </div>
                </div>                
            </div>

        </form>
        </div>
    </section>
</main>