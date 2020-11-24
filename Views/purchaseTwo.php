<?php
    require_once(VIEWS_PATH.'nav.php');
?>

<div class="container-fluid">
    <form action="<?php echo FRONT_ROOT ?>Purchase/SetPurchaseSelect?movieShowId=<?php echo $movieShow->getId()?>&numberOfTickets=<?php echo $numberOfTickets ?>" method="post">
    <div class="d-block w-75 mx-auto">
    <p class="text-white h4">
            Verify that all data is correct before proceed to pay
        </p>
        <p class="text-white">
            Movie: <?php echo $movieShow->getMovie()->getTitle(); ?>
        </p>
        <p class="text-white">
            Cinema: <?php echo $movieShow->getRoom()->getCinema()->getName(); ?>
        </p>
        <p class="text-white">
            Number of tickets: <?php echo $numberOfTickets; ?>
        </p>
        <p class="text-white">
            Day: <?php echo date_format($movieShow->getShowDate(), "Y-m-d"); ?>
        </p>
        <p class="text-white">
            Time: <?php echo date_format($movieShow->getShowDate(), "H:i:s"); ?>
        </p>
        <?php
            if($purchase->getDiscount() != 0)
            {
                echo "<p class='text-success'>Cogratulations! The selected day you have a discount of 25%!!</p>";
                echo "<p class='text-white'>Total with discount: ". $purchase->getTotal() ."</p>";
            }
            else
            {
                echo "<p class='text-white'>Total: ". $purchase->getTotal()."</p>";
            }
        ?>
        
        <button class="btn btn-danger" onclick="event.preventDefault(); history.go(-1);">Back </button>
        <button class="btn btn-primary" type="submit">Proceed to pay</button>
    </div>
        
    </form>    
</div>