<?php
    require_once('checkUser.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Movie Search</h2>
               <form action="<?php echo FRONT_ROOT ?>Movie/ShowResultMovieView" method="post" class="bg-light-alpha p-5">
                    <div class="row">                         
                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="category">Genre</label>
                                   <select name="categoryId" id="categoryId">
                                        <?php 
                                             foreach($genresList as $genre)
                                             {
                                                  ?>
                                                  <option value="<?php echo $genre->GetIdGenre() ?>"><?php echo $genre->GetNameGenre() ?></option>

                                                  <?php
                                             }
                                        ?>
                                   </select>

                              </div>
                         </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Buscar</button>
               </form>
          </div>
     </section>
</main>

<script src="<?php echo JS_PATH ?>date.js"></script>