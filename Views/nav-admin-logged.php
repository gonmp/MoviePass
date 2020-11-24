<?php
    require_once('checkAdmin.php');
?>
<div class="row">

        <!-- saludar al admin -->
        <strong><p class="col text-capitalize h4 text-white">Hello Admin!</p></strong>    

        <div class="btn-group">
                
            <!-- manu del admin -->
            <div class="dropdown">               
                
                <!-- boton del menu -->
                <button class="col rounded-0 btn btn-outline-primary dropdown-toggle text-warning" type="button" data-toggle="dropdown">MENU</button>                        

                <!-- elementos del menu -->
                <ul class="dropdown-menu">        
                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT?>/AdminManager/ShowAddCinemaView">Manage Cinemas</a></li>
                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT?>/MovieShow/ShowAddMovieShow">Manage Movies Shows</a></li>
                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT?>/AdminManager/ShowMovieList">List Movies</a></li>
                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT?>/Purchase/ShowAdminPurchasesMovie">Purchases by movie</a></li>
                    <li><a class="dropdown-item" href="<?php echo FRONT_ROOT?>/Purchase/ShowAdminPurchasesCinema">Purchases by cinema</a></li>
                </ul>
            </div>            

            <!-- actualizar base de datos -->
            <a href="<?php echo FRONT_ROOT ?>AdminManager/UpdateDataBase" class="rounded-0 col btn btn-outline-success text-white">UPDATE DATABASE</a>    
            
            <!-- logout -->
            <a href="<?php echo FRONT_ROOT ?>Home/Logout" class="rounded-0 col btn btn-outline-danger text-white">log out</a>
        </div>    
</div>