<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="roomAdd">
    <div class="container">

        <h1 class="text-danger">Add Room to: <span class="text-white"> <?php echo $cinema->getName(); ?></span></h1>        

        <form action="<?php echo FRONT_ROOT ?>Room/Add" method="post">                                
            <div class="row pb-2">            

                <input type="text" hidden name="cinemaName" value="<?php echo $cinema->getName();?>">

                <!-- seleccionar capacidad  -->
                <div class="col">                    
                    <label for="" class="text-primary d-block">select capacity</label>                    
                    <input required type="number" name="capacity" min="1" max="" value="" class="">                    
                </div>                                

                <!-- seleccionar valor del ticket -->
                <div class="col">                    
                    <label for="" class="text-primary d-block">select ticket value</label>                    
                    <input required type="number" name="ticketValue" value="" min="1" max="" class="">                    
                </div>                         

                <!-- seleccionar nombre -->
                <div class="col">                    
                    <label for="" class="text-primary d-block">room's name</label>                    
                    <input required type="text" name="name" placeholder="room's name" min="1" max="" class="" minlength="1" maxlength="20" pattern="[A-Za-z0-9 ]+" title="only letters and numbers">                    
                </div>                         


                <!-- botones -->
                <div class="btn-group">                                
                    <!-- boton agregar room -->
                    <div class="col">  
                        <label for="" class="text-success d-block">add room</label>
                        <button type="submit" class="btn btn-success btn-sm px-5 mb-1">ADD</button>
                    </div>

                    <!-- boton volver -->
                    <div class="col">  
                        <label for="" class="text-danger d-block">go back</label>
                        <a type="submit" href="<?php echo FRONT_ROOT . '/Cinema/ShowAddView' ?>" class="btn btn-danger btn-sm px-5 mb-1 text-white">BACK</a>
                    </div>
                </div>    

            </div>
        </form>        
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>





