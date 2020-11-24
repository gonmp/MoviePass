<?php
    require_once('checkAdmin.php');
?>
<main>
    <section id="roomAdd">
    <div class="container">
        <div class="transparentPanel p-1 row m-0 mt-2 rouded border border-primary border-bottom-0">
            <h1 class="text-white mText" style="font-size:3rem">Add Room to <span class="text-danger"> <?php echo $cinema->getName(); ?></span></h1>        

            <form action="<?php echo FRONT_ROOT ?>Room/Add" method="post">                                
                <div class="row pb-2">            

                    <input type="text" hidden name="cinemaName" value="<?php echo $cinema->getName();?>">

                    <!-- seleccionar nombre -->
                    <div class="col">                    
                        <label for="" class="mText d-block">room's name</label>                    
                        <input required type="text" name="name" placeholder="room's name" min="1" max="" class="bg-dark text-white" minlength="1" maxlength="20" pattern="[A-Za-z0-9 ]+" title="only letters and numbers">                    
                    </div>                         

                    <!-- seleccionar capacidad  -->
                    <div class="col">                    
                        <label for="" class="mText d-block">select capacity</label>                    
                        <input required type="number" name="capacity" min="1" max="" value="0" class="bg-dark text-white">                    
                    </div>                                

                    <!-- seleccionar valor del ticket -->
                    <div class="col">                    
                        <label for="" class="mText d-block">select ticket value</label>                    
                        <input required type="number" name="ticketValue" value="0" min="1" max="" class="bg-dark text-white">                    
                    </div>                         

                    <!-- botones -->
                    <div class="btn-group">                                
                        <!-- boton agregar room -->
                        <div class="col">  
                            <label for="" class="mText d-block">add room</label>
                            <button type="submit" class="mBtn btn btn-outline-success btn-sm px-5 mb-1 text-white">ADD</button>
                        </div>

                        <!-- boton volver -->
                        <div class="col">  
                            <label for="" class="mText d-block">go back</label>
                            <a type="submit" href="<?php echo FRONT_ROOT . '/Cinema/ShowAddView' ?>" class="mBtn btn btn-outline-danger btn-sm px-5 mb-1 text-white">BACK</a>
                        </div>
                    </div>    

                </div>
            </form>        
        </div>
    </section>
</main>
<script src="<?php echo JS_PATH ?>date.js"></script>





