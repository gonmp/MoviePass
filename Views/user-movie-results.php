<?php
    require_once('checkUser.php');
    require_once(VIEWS_PATH."user-movie-form.php");
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Result</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Title</th>
                         <th>Lenguage</th>
                         <th>Description</th>
                         <th>Genres</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($list as $movie)
                              {                                   
                                   ?>
                                        <tr>
                                             <td><?php echo $movie["title"]; ?></td>
                                             <td><?php echo $movie["original_language"]; ?></td>
                                             <td><?php echo $movie["overview"]; ?></td>
                                             <td><?php foreach($movie["genre"] as $genre) { echo $genre->GetNameGenre() . " ";} ?></td>                                            
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