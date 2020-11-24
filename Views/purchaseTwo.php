<?php
    require_once(VIEWS_PATH.'nav.php');
?>

<div class="container-fluid">
    <form action="<?php echo FRONT_ROOT ?>Purchase/ShowPurchaseViewThree?movieShowId=<?php echo $movieShow->getId()?>&numberOfTickets=<?php echo $numberOfTickets ?>" method="post">
    <div class="d-block w-75 mx-auto">
    <p class="text-white">
            Verifique que todos los datos sean correctos antes de pagar
        </p>
        <p class="text-white">
            Pelicula: <?php echo $movieShow->getMovie()->getTitle(); ?>
        </p>
        <p class="text-white">
            Cine: <?php echo $movieShow->getRoom()->getCinema()->getName(); ?>
        </p>
        <p class="text-white">
            Number of tickets: <?php echo $numberOfTickets; ?>
        </p>
        <p class="text-white">
            Día: <?php echo date_format($movieShow->getShowDate(), "Y-m-d"); ?>
        </p>
        <p class="text-white">
            Hora: <?php echo date_format($movieShow->getShowDate(), "H:i:s"); ?>
        </p>
        <button class="btn btn-danger" onclick="event.preventDefault(); history.go(-1);">Back </button>
        <button class="btn btn-primary" type="submit">Proceed to pay</button>
    </div>
        
    </form>    
</div>