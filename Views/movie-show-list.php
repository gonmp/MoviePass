<?php
    require_once('checkAdmin.php');
?>

<main class="">
     <section id="movieShowList" class="">
          <div class="container">               
               <table class="table table-hover table-dark table-sm">
                    <thead class="bg-dark">
                         <tr>
                              <th scope="col" class="text-primary">ID</th>
                              <th scope="col" class="text-light">Movie</th>    
                              <th scope="col" class="text-danger">Cinema</th>
                              <th scope="col" class="text-light">Room</th>
                              <th scope="col" class="text-primary">Date</th>
                              <th scope="col" class="text-success">Start Time</th>
                              <th scope="col" class="text-success">End Time</th>
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
                                        <td class="text-danger"><?php echo $movieShow->getRoom()->getCinema()->getName(); ?></td>
                                        <td><?php echo $movieShow->getRoom()->getName(); ?></td>
                                        <td class="text-primary"><?php echo $movieShow->getShowDate()->format('d-m-Y'); ?></td>
                                        <td class="text-success"><?php echo $movieShow->getShowDate()->format('H : i') . ' hs'; ?></td>
                                        <td class="text-success"><?php echo $movieShow->getEndTime()->format('H : i') . ' hs'; ?></td>

                                        <!-- boton modificar -->                                        
                                        <td><a href="<?php echo FRONT_ROOT?>MovieShow/ShowMovieShowUpdate?movieShowId=<?php echo $movieShow->getId();?>" class="btn btn-sm btn-outline-warning text-white">Change Movie</button></td>                                                                                     

                                        <!-- boton modificar -->                                        
                                        <td><a href="<?php echo FRONT_ROOT?>MovieShow/Delete?movieShowId=<?php echo $movieShow->getId();?>" class="btn btn-sm btn-outline-danger text-white">Delete</button></td>                                             
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