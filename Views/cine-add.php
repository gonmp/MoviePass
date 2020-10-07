<?php
    require_once('nav.php');
?>
<main class="py-5">
    <section id="Add Cine" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Add Cine<h2>
            <form action="<?php echo FRONT_ROOT ?>Cine/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">                         
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Capacity</label>
                            <input type="text" name="totalCapacity" value="" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Ticket value</label>
                            <input type="text" name="ticketValue" value="" class="form-control">
                        </div>
                    </div>

                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Add cine</button>
            </form>
        </div>
    </section>
</main>
    

