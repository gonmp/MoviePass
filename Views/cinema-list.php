<?php
    require_once('checkAdmin.php');
?>

<main class="">
     <section id="cinemaList" class="">
          <div class="container-fluid mt-4">               
               <table class="table table-hover table-dark table-sm">
                    <thead class="bg-dark">
                         <tr>
                              <th scope="col" class="text-primary">ID</th>
                              <th scope="col" class="text-primary">Name</th>
                              <th scope="col" class="text-primary">Capacity</th>
                              <th scope="col" class="text-primary">Address</th>
                              <th scope="col" class="text-primary">Ticket value</th>    
                              <th scope="col"></th>                     
                              <th scope="col"></th>                     
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                              foreach($cinemaList as $cinema)
                              {?>
                                   <tr>
                                        <td><?php echo $cinema->getId(); ?></td>
                                        <td><?php echo $cinema->getName(); ?></td>
                                        <td><?php echo $cinema->getTotalCapacity(); ?></td>
                                        <td><?php echo $cinema->getAddress(); ?></td>
                                        <td><?php echo $cinema->getTicketValue(); ?></td>

                                        <!-- boton modificar -->                                        
                                        <td><a href="<?php echo FRONT_ROOT?>Cinema/ShowUpdateView?name=<?php echo $cinema->getName();?>" class="btn btn-sm btn-outline-warning text-white">Modify</button></td>                                             

                                        <!-- boton modificar -->                                        
                                        <td><a href="<?php echo FRONT_ROOT?>Cinema/Delete?cinemaId=<?php echo $cinema->getId();?>" class="btn btn-sm btn-outline-danger text-white">Delete</button></td>                                             
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