<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Cine List</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Name</th>
                         <th>Capacity</th>
                         <th>Direction</th>
                         <th>Ticket value</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($cineList as $cine)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $cine->getName() ?></td>
                                             <td><?php echo $cine->getTotalCapacity() ?></td>
                                             <td><?php echo $cine->getAddress() ?></td>
                                             <td><?php echo $cine->getTicketValue() ?></td>
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
                </table>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Modify</button>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Delete</button>
        </div>
    </section>
</main>