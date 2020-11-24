<?php
    require_once(VIEWS_PATH.'nav.php');
?>

<div class="container">    
    <div class="transparentPanel p-2 mt-1 border border-primary border-bottom-0">
        
        <p class="mText" style="font-size:3rem">You need to be logged in order to buy tickets</p>        
        <button class="btn btn-outline-danger mBtn text-white" onclick="event.preventDefault(); history.go(-1);">Back </button>       
        
    </div>    
    
</div>