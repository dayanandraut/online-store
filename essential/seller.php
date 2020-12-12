<?php
include_once('queryrunner.php');

function getProductsToBeDelivered($sellerId){
    $q = "SELECT basket.quantity, basket.placed_date, customer.c_id,customer.name, customer.phone_no, product.product_name, product.product_id, product.price FROM `basket` inner join `product` inner join `customer` WHERE seller_id = $sellerId and basket.customer_id = customer.c_id and basket.product_id = product.product_id";
    $res = runQuery($q);
        if($res){
            return mysqli_fetch_all($res, MYSQLI_ASSOC);
        }
}

function deliverProduct($pid, $cid){
    $q = "DELETE FROM `basket` WHERE `basket`.`customer_id` = $cid AND `basket`.`product_id` = $pid";
    return runQuery($q);        
}

?>