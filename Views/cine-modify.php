<?php
    require_once('nav.php');
?>
<main class="py-5">
    <section id="Modify Cine" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Modify Cine<h2>
            <form action="<?php echo FRONT_ROOT ?>Cine/Modify" method="post" class="bg-light-alpha p-5">
                <div class="row">                         
                    <div class="col-lg-4">
                        <div class="form-group">             
                            <input type="hidden" name="id" value="<?php echo $cine->getId();?>"  />

                            <label for="">Name</label>                            
                            <input type="text" name="name" value="<?php echo $cine->getName();?>" class="form-control" >
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Capacity</label>
                            <input type="text" name="totalCapacity" value="<?php echo $cine->getTotalCapacity();?>" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" value="<?php echo $cine->getAddress();?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Ticket value</label>
                            <input type="text" name="ticketValue" value="<?php echo $cine->getTicketValue();?>" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Save</button>
            </form>
        </div>
    </section>
</main>
    

