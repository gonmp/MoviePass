<?php
    require_once('checkAdmin.php');
?>

<main class="">
     <section id="movieShowList" class="">
          <div class="container">       
               <div class="mt-2 rounded border border-primary border-bottom-0 p-1 transparentPanel">    

                    <h3 class="mText text-white" style="font-size:3rem">Modifying Movie Show: <span class="text-danger" style="font-size:4rem"><?php echo $auxMovieShow->getId();?></span></h3>    
                    <table class="m-0 p-1 table table-hover table-dark table-sm">
                         <thead class="bg-dark">
                              <tr>
                                   <th scope="col" class="text-primary mText">ID</th>
                                   <th scope="col" class="text-light mText">Movie</th>    
                                   <th scope="col" class="text-primary mText">Date</th>
                                   <th scope="col" class="text-danger mText">Cinema</th>
                                   <th scope="col" class="text-light mText">Room</th>
                                   <th scope="col" class="text-success mText">Start Time</th>
                                   <th scope="col" class="text-success mText">End Time</th>                              
                              </tr>
                         </thead>
                         <tbody>                         
                              <tr>
                                   <td class="text-primary"><?php echo $auxMovieShow->getId(); ?></td>
                                   <td class="text-white"><?php echo $auxMovieShow->getMovie()->getTitle(); ?></td>
                                   <td class="text-primary"><?php echo $auxMovieShow->getShowDate()->format('d-m-Y'); ?></td>
                                   <td class="text-danger"><?php echo $auxMovieShow->getCinemaName(); ?></td>
                                   <td><?php echo $auxMovieShow->getRoom()->getName(); ?></td>
                                   <td class="text-success"><?php echo $auxMovieShow->getShowDate()->format('H : i') . ' hs'; ?></td>
                                   <td class="text-success"><?php echo $auxMovieShow->getEndTime()->format('H : i') . ' hs'; ?></td>                              
                              </tr>                                                                                      
                         </tbody>
                    </table>             
               </div>                 
        </div>
    </section>
</main>