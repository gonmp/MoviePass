<nav class="container">     
     <div class="row p-1 border border-top-0 border-primary rounded-bottom m-0 transparentPanel">

          <!-- primera columna: moviepass logo -->
          <div class="col-7">
               <a href="<?php echo FRONT_ROOT ?>Home/Index">
                    <img src="<?php echo FRONT_ROOT ."/". VIEWS_PATH?>/img/moviepass_logo.png" alt="moviepass logo" class="img-fluid border border-dark rounded" style="width: 9rem">
               </a>
          </div>

          <!-- segunda columna: segun estado del usuario -->
          <div class="col">               
               <?php                

               if ($_SESSION['userLogged'])
               {
                    if ($_SESSION['userLogged']->GetAdmin())
                    {
                         # admin
                         require_once('nav-admin-logged.php');                         
                    }
                    else
                    {
                         # cliente
                         require_once('nav-user-logged.php');
                    }                    
               }
               else
               {
                    if ($_SESSION['actualView'] == "register")
                    {
                         require_once('nav-register.php');                         
                    }
                    else
                    {
                         require_once('nav-user-no-logged.php');                    
                    }                    
               }               
               ?>
          </div>
     </div>     
     
     <!-- background video -->
     <div style="width: 200%; height: 200%; position: fixed; left:-50%; top: -50%; z-index: -99; pointer-events: none">
          <iframe width="100%" height="100%" src="https://www.youtube.com/embed/sRE5iQCdRvE?mute=1&autoplay=1&controls=0&loop=1"> </iframe>
     </div>
</nav>     