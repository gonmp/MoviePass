<?php
    require_once(VIEWS_PATH.'nav.php');
?>

<div class="container">                         
    <div clas="row">
        <div class="transparentPanel border border-primary border-bottom-0 rounded mt-1 p-1">
            
            <h3 class="mText" style="font-size:3rem">
                You are about to buy tickets for <span class="text-white"><?php echo $movieShow->getMovie()->getTitle(); ?></span>  
            </h3>

            <form class="p-2" action="<?php echo FRONT_ROOT ?>Purchase/ShowPurchaseViewTwo?movieShowId=<?php echo $movieShow->getId()?>" method="post">                
                <label class="mText text-white d-block h4" for="quantity">First select the number of tickets do you want</label>
                <input class="bg-dark text-white w-25" type="number" id="quantity" min="1" name="numberOfTickets" value="0" required>
                <p id="error" class="mText">
                    
                </p>
                <button class="mBtn text-white btn btn-outline-primary" type="submit" onclick="return validate()">Next</button>

            </form>   
        </div>
    </div>
</div>
<script>
function validate() {
    let x = <?php echo $remanentSpots ?>;
    let text;
    let input;

    input = document.getElementById("quantity").value;
    if(input > x)
    {
        text = "Sorry, but there are not that many tickets available. There are only " + <?php echo $remanentSpots ?> + " spots available.";
        document.getElementById("error").innerHTML = text;
        return false
    }
    else
    {
        text = "";
        document.getElementById("error").innerHTML = text;
        return true;
    }    
}
</script>