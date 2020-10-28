<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Cinema List</h2>
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
                              foreach($cinemaList as $cinema)
                              {                                   
                                   ?>
                                        <tr>
                                             <td><?php echo $cinema->getId(); ?></td>
                                             <td><?php echo $cinema->getName(); ?></td>
                                             <td><?php echo $cinema->getTotalCapacity(); ?></td>
                                             <td><?php echo $cinema->getAddress(); ?></td>
                                             <td><?php echo $cinema->getTicketValue(); ?></td>
                                             <td><?php echo ($cinema->getEnabled() == true)? "true" : "false"; ?></td>
                                             
                                             <td><a href="<?php echo FRONT_ROOT?>Cinema/ShowModifyView?idCinema=<?php echo $cinema->getId();?>" class="btn btn-dark ml-auto d-block">Modify</button></td>
                                             <td><a href="<?php echo FRONT_ROOT?>Cinema/Delete?idCinema=<?php echo $cinema->getId();?>" class="btn btn-dark ml-auto d-block">Delete/Undelete</button></td>                                             
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