<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Cine List</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Capacity</th>
                         <th>Direction</th>
                         <th>Ticket value</th>
                         <th>Enabled</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($cineList as $cine)
                              {                                   
                                   ?>
                                        <tr>
                                             <td><?php echo $cine->getId(); ?></td>
                                             <td><?php echo $cine->getName(); ?></td>
                                             <td><?php echo $cine->getTotalCapacity(); ?></td>
                                             <td><?php echo $cine->getAddress(); ?></td>
                                             <td><?php echo $cine->getTicketValue(); ?></td>
                                             <td><?php echo ($cine->getEnabled() == true)? "true" : "false"; ?></td>
                                             
                                             <td><a href="<?php echo FRONT_ROOT?>Cine/ShowModifyView?idCine=<?php echo $cine->getId();?>" class="btn btn-dark ml-auto d-block">Modify</button></td>
                                             <td><a href="<?php echo FRONT_ROOT?>Cine/Delete?idCine=<?php echo $cine->getId();?>" class="btn btn-dark ml-auto d-block">Delete/Undelete</button></td>                                             
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
                </table>                                
        </div>
    </section>
</main>