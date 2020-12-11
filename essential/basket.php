<?php
include_once('queryrunner.php');
    function getCustomerBasket($customerId){
        $sql = "SELECT * FROM `basket` inner join `product` WHERE customer_id = $customerId and basket.product_id = product.product_id";
        $res = runQuery($sql);
        if($res){
            return mysqli_fetch_all($res, MYSQLI_ASSOC);
        }
      
    }

    function addToBasket($customerId, $productId, $qty){
        $sql = "INSERT INTO `basket` (`customer_id`, `product_id`, `quantity`) VALUES ('$customerId', '$productId', '$qty')";
        return runQuery($sql);
    }

?>