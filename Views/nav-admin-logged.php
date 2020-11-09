<div class="float-right mt-1 mx-0">
    
    <!-- logout -->
    <a href="<?php echo FRONT_ROOT ?>Home/Logout" class="mx-2 float-right btn btn-outline-danger btn-sm text-white">log out</a>

    <!-- actualizar base de datos -->
    <a href="<?php echo FRONT_ROOT ?>AdminManager/UpdateDataBase" class="float-right btn btn-success btn-sm text-white">UPDATE DATABASE</a>    
    
    <!-- manu del admin -->
    <div class="mx-2 dropdown float-right">               
        
        <!-- boton del menu -->
        <button class="btn btn-outline-primary btn-sm dropdown-toggle mx-2 mb-0 ml-0 p-1 pb-1 px-4 text-warning" type="button" data-toggle="dropdown">MENU</button>                        

        <!-- elementos del menu -->
        <ul class="dropdown-menu">        
            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT?>/AdminManager/ShowAddCinemaView">Manage Cinemas</a></li>
            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT?>/AdminManager/ShowAddMovieShowView">Manage Movies Shows</a></li>
            <li><a class="dropdown-item disabled" href="#">Manage Room</a></li>        
            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT?>/AdminManager/ShowMovieList">List Movies</a></li>
        </ul>
    </div>    

    <!-- saludar al admin -->
    <strong><p class="mr-4 text-capitalize h4 d-inline text-white float-right">Hello Admin!</p></strong>    
    
</div>