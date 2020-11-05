<?php
    require_once('checkAdmin.php');
?>
<main class="py-5">
    <section id="Modify Cinema" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Modify Cinema<h2>
            <form action="<?php echo FRONT_ROOT ?>Cinema/Update" method="post" class="bg-light-alpha p-5">
                <div class="row">                         
                    <div class="col-lg-4">
                        <div class="form-group">             
                            <input type="hidden" name="id" value="<?php echo $cinema->getId();?>"  />

                            <label for="">Name</label>                            
                            <input type="text" pattern="[A-Za -z0-9]+" title="Only letters and numbers" name="name" value="<?php echo $cinema->getName();?>" class="form-control" minlength="1" maxlength="50" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Capacity</label>
                            <input type="number" name="totalCapacity" value="<?php echo $cinema->getTotalCapacity();?>" class="form-control"  min="1" max="500" required>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" pattern="[A-Za -z0-9]+" title="Only letters and numbers" name="address" value="<?php echo $cinema->getAddress();?>" class="form-control" minlength="1" maxlength="100" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Ticket value</label>
                            <input type="number" name="ticketValue" value="<?php echo $cinema->getTicketValue();?>" class="form-control" min="1" max="500" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="Enabled">Enabled</label>
                            <input id="Enabled" type="radio" name="enable" value="1" required>
                            
                            <label for="Disabled">Disabled</label>
                            <input id="Disabled" type="radio" name="enable" value="0" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Save</button>
            </form>
        </div>
    </section>
</main>
    

