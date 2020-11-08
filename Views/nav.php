<?php     
   /*  if (!isset($_SESSION['validLogin']))
     {
          header("location:GoHome");
     }
     else if (!$_SESSION['validLogin'])
     {
          header("location:GoHome");
     }     */     
?>

<nav class="container-fluid">     
     
     <!-- fila principal -->
     <div class="row"> 

          <!-- primera columna: moviepass logo -->
          <div class="col p-1">
               <a href="<?php echo FRONT_ROOT ?>Home/Index">
                    <img src="<?php echo FRONT_ROOT ."/". VIEWS_PATH?>/img/moviepass_logo.png" alt="moviepass logo" class="img-fluid border border-dark rounded" style="width: 9rem">
               </a>
          </div>

          <!-- segunda columna: segun estado del usuario -->
          <div class="col-5 py-1 mx-0">               
               <?php                

               if ($_SESSION['userLogged'])
               {
                    if ($_SESSION['userLogged']->GetAdmin())
                    {
                         # admin
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
<hr class="hr-style mt-1">


