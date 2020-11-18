<nav class="container">     
     <div class="row align-items-center py-2 border border-top-0 border-secondary rounded-bottom m-0">

          <!-- primera columna: moviepass logo -->
          <div class="col">
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
</nav>     



