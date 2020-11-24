<?php
    require_once(VIEWS_PATH.'nav.php');
?>

<div class="container-fluid">
    <div class="d-block w-50 mx-auto">
        <p class="text-white h3">
            You need to be logged in order to buy tickets
        </p>
        <button class="btn btn-danger" onclick="event.preventDefault(); history.go(-1);">Back </button>
        <a href="<?php echo FRONT_ROOT ?>User/ShowLoginView" class="btn btn-primary">Login</a>
    </div>
</div>