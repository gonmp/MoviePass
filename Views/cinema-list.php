<main class="">
     <section id="cinemaList" class="">
          <div class="container-fluid mt-4">
               <h2 class="h2 mb-3 text-primary float-right mr-4">Cinema List</h2>
               <table class="table table-hover table-dark table-sm">
                    <thead class="bg-dark">
                         <tr>
                              <th scope="col" class="text-primary">ID</th>
                              <th scope="col" class="text-primary">Name</th>
                              <th scope="col" class="text-primary">Capacity</th>
                              <th scope="col" class="text-primary">Direction</th>
                              <th scope="col" class="text-primary">Ticket value</th>    
                              <th scope="col"></th>                     
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                              foreach($cinemaList as $cinema)
                              {?>
                                   <tr>
                                        <td><?php echo $cinema->getId(); ?></td>
                                        <th scope="row" class="text-warning"><?php echo $cinema->getName(); ?></td>
                                        <td><?php echo $cinema->getTotalCapacity(); ?></td>
                                        <td><?php echo $cinema->getAddress(); ?></td>
                                        <td><?php echo $cinema->getTicketValue(); ?></td>
                                        
                                        <td><a href="<?php echo FRONT_ROOT?>AdminManager/ShowUpdateView?name=<?php echo $cinema->getName();?>" class="btn btn-sm btn-outline-warning">Modify this cinema</button></td>                                             
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