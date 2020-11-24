<?php
    //require_once('checkAdmin.php');
?>

<main class="">
     <section id="roomList">
          <div class="container">               
               <table class="table table-hover table-dark table-sm">
                    <thead class="bg-dark">
                         <tr>
                              <th scope="col" class="text-primary">ID</th>
                              <th scope="col" class="text-primary">Name</th>                                                            
                              <th scope="col" class="text-primary">Capacity</th>                              
                              <th scope="col" class="text-primary">Ticket Value</th>                              
                              <th></th>
                              <th></th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                              foreach($roomsList as $room)
                              {?>
                                   <tr>
                                        <td><?php echo $room->getId(); ?></td>
                                        <td><?php echo $room->getName(); ?></td>                                                                                
                                        <td><?php echo $room->getCapacity(); ?></td>                                        
                                        <td><?php echo $room->getTicketValue(); ?></td>                                        

                                        <!-- boton modificar -->                                        
                                        <td><a href="<?php echo FRONT_ROOT?>Room/ShowUpdateView?roomId=<?php echo $room->getId();?>" class="btn btn-sm btn-outline-warning text-white">Modify</button></td>                                             

                                        <!-- boton borrar -->                                        
                                        <td><a href="<?php echo FRONT_ROOT?>Room/Delete?roomId=<?php echo $room->getId();?>" class="btn btn-sm btn-outline-danger text-white">Delete</button></td>                                             
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