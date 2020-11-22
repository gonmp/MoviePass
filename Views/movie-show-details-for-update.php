<?php
    require_once('checkAdmin.php');
?>

<main class="">
     <section id="movieShowList" class="">
          <div class="container">           
               <h3 class="text-primary">Modifying Movie Show: <span class="text-white"><?php echo $auxMovieShow->getId();?></span></h3>    
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
                         </tr>
                    </thead>
                    <tbody>                         
                         <tr>
                              <td class="text-primary"><?php echo $auxMovieShow->getId(); ?></td>
                              <td class="text-white"><?php echo $auxMovieShow->getMovie()->getTitle(); ?></td>
                              <td class="text-danger"><?php echo $auxMovieShow->getRoom()->getCinema()->getName(); ?></td>
                              <td><?php echo $auxMovieShow->getRoom()->getName(); ?></td>
                              <td class="text-primary"><?php echo $auxMovieShow->getShowDate()->format('d-m-Y'); ?></td>
                              <td class="text-success"><?php echo $auxMovieShow->getShowDate()->format('H : i') . ' hs'; ?></td>
                              <td class="text-success"><?php echo $auxMovieShow->getEndTime()->format('H : i') . ' hs'; ?></td>                              
                         </tr>                                                                                      
                    </tbody>
                </table>                              
        </div>
    </section>
</main>