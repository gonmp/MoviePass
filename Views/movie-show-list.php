<?php
    require_once('checkAdmin.php');
?>

<main class="">
     <section id="movieShowList" class="">
          <div class="container">               
               <table class="border border-secondary rounded mt-2 table table-hover table-dark table-sm">
                    <thead class="bg-dark">
                         <tr>
                              <th scope="col" class="text-primary mText">ID</th>
                              <th scope="col" class="text-light mText">Movie</th>    
                              <th scope="col" class="text-primary mText">Date</th>
                              <th scope="col" class="text-danger mText">Cinema</th>
                              <th scope="col" class="text-light mText">Room</th>
                              <th scope="col" class="text-success mText">Start Time</th>
                              <th scope="col" class="text-success mText">End Time</th>
                              <th scope="col" class="text-warning mText">Tickets Sold</th>
                              <th scope="col" class="text-white mText">Available Spots</th>
                              <th scope="col"></th>                     
                              <th scope="col"></th>    
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                              foreach($movieShowList as $movieShow)
                              {?>
                                   <tr>
                                        <td class="text-primary"><?php echo $movieShow->getId(); ?></td>
                                        <td><?php echo $movieShow->getMovie()->getTitle(); ?></td>    
                                        <td class="text-primary"><?php echo $movieShow->getShowDate()->format('d-m-Y'); ?></td>
                                        <td class="text-danger"><?php echo $movieShow->getRoom()->getCinema()->getName(); ?></td>
                                        <td><?php echo $movieShow->getRoom()->getName(); ?></td>
                                        <td class="text-success"><?php echo $movieShow->getShowDate()->format('H : i') . ' hs'; ?></td>
                                        <td class="text-success"><?php echo $movieShow->getEndTime()->format('H : i') . ' hs'; ?></td>
                                        <td class="text-warning"><?php echo $this->purchaseDAO->GetTicketsSoldByMovieShowId($movieShow->getId()); ?></td>
                                        <td class="text-white"><?php echo $movieShow->getRoom()->getCapacity() - $this->purchaseDAO->GetTicketsSoldByMovieShowId($movieShow->getId()); ?></td>

                                        <!-- boton modificar -->                                        
                                        <td><a href="<?php echo FRONT_ROOT?>MovieShow/ShowMovieShowUpdate?movieShowId=<?php echo $movieShow->getId();?>" class="btn btn-sm btn-outline-warning text-white mBtn">Change</button></td>                                                                                     

                                        <!-- boton modificar -->                                        
                                        <td><a href="<?php echo FRONT_ROOT?>MovieShow/Delete?movieShowId=<?php echo $movieShow->getId();?>" class="btn btn-sm btn-outline-danger text-white mBtn">Delete</button></td>                                             
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