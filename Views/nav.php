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

<nav class="container-fluid p-0 m-0">     
     <div class="row py-1">          
          <!-- moviepass logo -->
          <div class="col p-1 mx-3">
               <a href="<?php echo FRONT_ROOT ?>Home/Index">
                    <img src="<?php echo FRONT_ROOT ."/". VIEWS_PATH?>/img/moviepass_logo.png" alt="moviepass logo" class="img-fluid border border-dark rounded" style="width: 9rem">
               </a>
          </div>

          <div class="col-5 py-1">               
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

     <?php
     if (isset($_SESSION['adminLogged']))
     {
          if ($_SESSION['adminLogged'] == true)
          {
          ?>                     
               <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/ShowAddView">Add Cinema</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cinema/ShowListView">List Cinema</a>
               </li>          
          </ul>        
          
          <?php
          }
     }?>  
</nav>     


