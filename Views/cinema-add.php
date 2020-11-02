<?php
    require_once('checkAdmin.php');
?>
<main class="py-5">
    <section id="Add Cinema" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Add Cinema<h2>
            <form action="<?php echo FRONT_ROOT ?>Cinema/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">                         
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" pattern="[A-Za-z0-9 ]+" title="Only letters and numbers" name="name" value="" class="form-control" minlength="2" maxlength="50" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Capacity</label>
                            <input type="number" name="totalCapacity" value="" class="form-control" min="1" max="500" required>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" pattern="[A-Za-z0-9]+" title="Only letters and numbers" name="address" value="" class="form-control" minlength="10" maxlength="100" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Ticket value</label>
                            <input type="number" name="ticketValue" value="" class="form-control" min="1" max="500" required>
                        </div>
                    </div>
                    
                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Add cinema</button>
            </form>
        </div>
    </section>
</main>
    

