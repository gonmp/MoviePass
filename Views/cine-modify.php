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
                            <input type="text" pattern="[A-Za-z0-9]+" title="Only letters and numbers" name="name" value="<?php echo $cine->getName();?>" class="form-control" minlength="2" maxlength="50" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Capacity</label>
                            <input type="number" name="totalCapacity" value="<?php echo $cine->getTotalCapacity();?>" class="form-control"  min="1" max="500" required>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" pattern="[A-Za-z0-9]+" title="Only letters and numbers" name="address" value="<?php echo $cine->getAddress();?>" class="form-control" minlength="10" maxlength="100" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Ticket value</label>
                            <input type="number" name="ticketValue" value="<?php echo $cine->getTicketValue();?>" class="form-control" min="1" max="500" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Save</button>
            </form>
        </div>
    </section>
</main>
    

