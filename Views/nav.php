<?php     
     if (!isset($_SESSION['validLogin']))
     {
          header("location:GoHome");
     }
     else if (!$_SESSION['validLogin'])
     {
          header("location:GoHome");
     }     
?>

<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Index"><strong>HOME</strong> </a>
     </span>

     <?php
     if (isset($_SESSION['adminLogged']))
     {
          if ($_SESSION['adminLogged'] == true)
          {
          ?>                     
               <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cine/ShowAddView">Add Cine</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cine/ShowListView">List Cine</a>
               </li>          
          </ul>        
          
          <?php
          }
     }?>  
</nav>     


