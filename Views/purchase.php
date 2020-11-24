<?php
    require_once(VIEWS_PATH.'nav.php');
?>

<div class="container-fluid">                         
    <h3 class="text-white m-4">
        You are about to buy tickets for <?php echo $movieShow->getMovie()->getTitle(); ?>  
    </h3>
    <form action="<?php echo FRONT_ROOT ?>Purchase/ShowPurchaseViewTwo?movieShowId=<?php echo $movieShow->getId()?>" method="post">
        <div class="d-block w-75 mx-auto">
            <label class="text-white d-block h4" for="quantity">First select the number of tickets do you want</label>
            <input class="w-25" type="number" id="quantity" min="1" name="numberOfTickets" required>
            <p id="error" class="text-danger">
                
            </p>
            <button class="btn btn-primary" type="submit" onclick="return validate()">Next</button>
        </div>
    </form>   
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