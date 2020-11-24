<?php
    require_once(VIEWS_PATH.'nav.php');
?>

<div class="container">
    <div class="row m-0 p-0">        
        <div class="transparentPanel border border-bottom-0 border-primary rounded mt-1">        
            <form class="p-3" action="<?php echo FRONT_ROOT ?>Purchase/SetPurchaseSelect?movieShowId=<?php echo $movieShow->getId()?>&numberOfTickets=<?php echo $numberOfTickets ?>" method="post">
                
                <p class="mText" style="font-size:3rem">
                        Verify that all data is <span class="text-danger">correct</span> before proceed to pay</span>
                    </p>
                    <p class="mText text-white">
                        Movie: <span class="text-warning"><?php echo $movieShow->getMovie()->getTitle(); ?></span>
                    </p>
                    <p class="mText text-white">
                        Cinema: <span class="text-warning"><?php echo $movieShow->getRoom()->getCinema()->getName(); ?></span>
                    </p>
                    <p class="mText text-white">
                        Number of tickets: <span class="text-warning"><?php echo $numberOfTickets; ?></span>
                    </p>
                    <p class="mText text-white">
                        Day: <span class="text-warning"> <?php echo date_format($movieShow->getShowDate(), "Y-m-d"); ?></span>
                    </p>
                    <p class="mText text-white">
                        Time: <span class="text-warning"> <?php echo date_format($movieShow->getShowDate(), "H:i:s"); ?></span>
                    </p>
                    <?php
                        if($purchase->getDiscount() != 0)
                        {
                            echo "<p class='mText'>Cogratulations! The selected day you have a discount of 25%!!</p>";
                            echo "<p class='text-white mText'>Total with discount: <span class='text-warning'>". $purchase->getTotal() ."</span></p>";
                        }
                        else
                        {
                            echo "<p class='mText text-white'>Total: <span class='text-warning'>". $purchase->getTotal()."</span></p>";
                        }
                    ?>
                    
                    <button class="mBtn text-white btn btn-outline-danger" onclick="event.preventDefault(); history.go(-1);">Back </button>
                    <button class="mBtn btn btn-outline-primary text-white" type="submit">Proceed to pay</button>
                
            </div>
        </form>    
    </div>
</div>