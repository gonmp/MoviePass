<?php
    namespace DAO;

    use Models\Purchase as Purchase;

    interface IPurchaseDAO
    {
        function AddPurchase(Purchase $purchase);      
    }
?>