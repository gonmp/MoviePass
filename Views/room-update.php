<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="roomAdd">
    <div class="container">
        <div class="transparentPanel row m-0 mt-2 p-2 border border-primary border-bottom-0 rounded">

            <h1 class="mText text-white" style="font-size: 3rem">Modifying Room id: <span class="text-danger" style="font-size:4rem"><?php echo $room->getId();?></span></h1>
            <form action="<?php echo FRONT_ROOT ?>Room/Update" method="post">            
                
                <div class="row">               

                    <!-- id -->
                    <input hidden name="roomId" value="<?php echo $room->getId();?>">                

                    <!-- cinema -->
                    <input hidden name="cinemaName" value="<?php echo $room->getCinema()->getName();?>">                

                    <!-- seleccionar nombre -->
                    <div class="col">                    
                        <label for="" class="mText d-block">room's name</label>                    
                        <input required type="text" value="<?php echo $room->getName()?>" name="name" placeholder="room's name" min="1" max="" class="my-1 bg-dark text-white" minlength="1" maxlength="20" pattern="[A-Za-z0-9 ]+" title="only letters and numbers">                    
                    </div>                         
                    
                    <!-- seleccionar capacidad  -->
                    <div class="col">                    
                        <label for="" class="mText d-block">select capacity</label>                    
                        <input required type="number" value="<?php echo $room->getCapacity()?>" name="capacity" min="1" max="" value="0" class="my-1 bg-dark text-white">                    
                    </div>                                

                    <!-- seleccionar valor del ticket -->
                    <div class="col">                    
                        <label for="" class="mText d-block">select ticket value</label>                    
                        <input required type="number" value="<?php echo $room->getTicketValue()?>" name="ticketValue" value="0" min="1" max="" class="my-1 bg-dark text-white">                    
                    </div>                         

                                    
                    <!-- boton modificar -->
                    <div class="btn-group">                
                        <div class="col">  
                            <label for="" class="mText d-block">modify</label>
                            <button type="submit" class="mBtn btn btn-outline-warning btn-sm px-4 mb-1 text-white">MODIFY ROOM</button>
                        </div>

                        <div class="col">  
                            <label for="" class="mText d-block">go back</label>
                            <a href="<?php echo FRONT_ROOT . '/Room/ShowAddRoom?cinemaName=' . $room->getCinema()->getName();?>" class="mBtn btn btn-outline-danger btn-sm px-5 mb-1 text-white">GO BACK</a>
                        </div>
                    </div>                
                </div>
            </form>
            </div>
        </div>
    </section>
</main>