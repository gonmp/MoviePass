<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de cines</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Nombre</th>
                         <th>Capacidad</th>
                         <th>Direccion</th>
                         <th>Valor de la entrada</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($cinelist as $cine)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $cine->getNombreCine() ?></td>
                                             <td><?php echo $cine->getCapacidadTotal() ?></td>
                                             <td><?php echo $cine->getDireccion() ?></td>
                                             <td><?php echo $cine->getValorEntrada() ?></td>
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
                </table>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Modificar</button>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Borrar</button>
        </div>
    </section>
</main>