<?php
    require_once('nav.php');
?>
<main class="py-5">
    <section id="Agregar Cine" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar cine<h2>
            <form action=<?php echo FRONT_ROOT ?>Cine/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">                         
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Nombre del cine</label>
                            <input type="text" name="nombreCine" value="" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Capacidad</label>
                            <input type="text" name="capacidad" value="" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Direccion</label>
                            <input type="text" name="direccion" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Valor de la entrada</label>
                            <input type="text" name="valorEntrada" value="" class="form-control">
                        </div>
                    </div>

                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
            </form>
        </div>
    </section>
</main>
    

