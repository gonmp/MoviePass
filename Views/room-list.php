<?php
    //require_once('checkAdmin.php');
?>

<main class="">
     <section id="roomList">
          <div class="container mt-1">               
               <table class="table table-hover table-dark table-sm border border-secondary">
                    <thead class="bg-dark mText">
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
                                        <td class="mText"><?php echo $room->getId(); ?></td>
                                        <td class="mText"><?php echo $room->getName(); ?></td>                                                                                
                                        <td class="mText"><?php echo $room->getCapacity(); ?></td>                                        
                                        <td class="mText"><?php echo $room->getTicketValue(); ?></td>                                        

                                        <!-- boton modificar -->                                        
                                        <td><a href="<?php echo FRONT_ROOT?>Room/ShowUpdateView?roomId=<?php echo $room->getId();?>" class="mBtn btn btn-sm btn-outline-warning text-white">Modify</button></td>                                             

                                        <!-- boton borrar -->                                        
                                        <td><a href="<?php echo FRONT_ROOT?>Room/Delete?roomId=<?php echo $room->getId();?>" class="mBtn btn btn-sm btn-outline-danger text-white">Delete</button></td>                                             
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