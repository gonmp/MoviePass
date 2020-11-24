<?php
    require_once('checkAdmin.php');
?>
<main>
    <?php require_once('admin-purchase-movie.php') ?>
    
    <section>
        <div class="container mt-1">
            <table class="border border-secondary table table-hover table-dark table-sm">
                <thead class="bg-dark">
                        <tr>
                            <th scope="col" class="mText text-primary">Movie</th>
                            <th scope="col" class="mText text-light">From</th>    
                            <th scope="col" class="mText text-primary">To</th>
                            <th scope="col" class="mText text-danger">Total</th>                              
                        </tr>
                </thead>
                <tbody>                         
                        <tr>
                            <td class="text-primary"><?php echo $movieSelect->getTitle(); ?></td>
                            <td class="text-white"><?php echo $dateFromString; ?></td>
                            <td class="text-primary"><?php echo $dateToString; ?></td>
                            <td class="text-danger"><?php echo $total; ?></td>                        
                        </tr>                                                                                      
                </tbody>
            </table>
        </div>
    </section>
</main>