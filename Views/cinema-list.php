<?php
    require_once('checkAdmin.php');
?>

<main class="">
     <section id="cinemaList" class="">
          <div class="container">               
               <table class="rounded mt-2 border border-secondary mText table table-hover table-dark table-sm">
                    <thead class="bg-dark">
                         <tr>
                              <th scope="col" class="text-primary">ID</th>
                              <th scope="col" class="text-primary">Name</th>                              
                              <th scope="col" class="text-primary">Address</th>                              
                              <th scope="col"></th>                     
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
                                        <td><?php echo $cinema->getAddress(); ?></td>                                        

                                        <!-- boton room details -->                                        
                                        <td><a href="<?php echo FRONT_ROOT?>Cinema/ShowRooms?cinemaName=<?php echo $cinema->getName();?>" class="mBtn btn btn-sm btn-outline-success text-white">Rooms details</button></td>                                             

                                        <!-- boton modificar -->                                        
                                        <td><a href="<?php echo FRONT_ROOT?>Cinema/ShowUpdateView?name=<?php echo $cinema->getName();?>" class="mBtn btn btn-sm btn-outline-warning text-white">Modify</button></td>                                             

                                        <!-- boton modificar -->                                        
                                        <td><a href="<?php echo FRONT_ROOT?>Cinema/Delete?cinemaId=<?php echo $cinema->getId();?>" class="mBtn btn btn-sm btn-outline-danger text-white">Delete</button></td>                                             
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