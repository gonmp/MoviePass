<?php

if (isset($_SESSION['userLoged']))
{
     if ($_SESSION['userLoged'] == false)
     {          
          $homeController = new Controllers\HomeController();
          $homeController->Index("Debe loguerse");
     }
}
?>

<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <a class="nav-link" href="<?php echo FRONT_ROOT ?>Home/Index"><strong>HOME</strong> </a>
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cine/ShowAddView">Add Cine</a>
          </li>
          <li class="nav-item">
               <a class="nav-link" href="<?php echo FRONT_ROOT ?>Cine/ShowListView">List Cine</a>
          </li>          
     </ul>
</nav>