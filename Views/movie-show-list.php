<main class="">
     <section id="movieShowList" class="">
          <div class="container-fluid mt-4">               
               <table class="table table-hover table-dark table-sm">
                    <thead class="bg-dark">
                         <tr>
                              <th scope="col" class="text-primary">ID</th>
                              <th scope="col" class="text-primary">Movie</th>    
                              <th scope="col" class="text-primary">Cinema</th>
                              <th scope="col" class="text-primary">Date</th>
                              <th scope="col" class="text-primary">Time</th>
                              <th scope="col"></th>                     
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                              foreach($movieShowList as $movieShow)
                              {?>
                                   <tr>
                                        <td><?php echo $movieShow->getId(); ?></td>
                                        <td><?php echo $movieShow->getMovie()->getTitle(); ?></td>    
                                        <td><?php echo $movieShow->getCinema()->getName(); ?></td>
                                        <td><?php echo $movieShow->getShowDate()->format('d-m-Y'); ?></td>
                                        <td><?php echo $movieShow->getShowDate()->format('H : i') . ' hs'; ?></td>

                                        <!-- boton modificar -->                                        
                                        <td><a href="<?php echo FRONT_ROOT?>MovieShow/ShowMovieShowUpdate?movieShowId=<?php echo $movieShow->getId();?>" class="btn btn-sm btn-outline-warning">Modify</button></td>                                                                                     
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