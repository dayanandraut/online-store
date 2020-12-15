<?php

include_once('queryrunner.php');

function getProductDetails($productId){
    $sql = "SELECT * FROM `product` WHERE product_id = $productId";
    return runQuery($sql);
}

function updateProductQty($productId, $qty, $sold){
    $sql = "UPDATE `product` set availability = availability - $qty WHERE product_id = $productId";
    if(!$sold){
        $sql = "UPDATE `product` set availability = availability + $qty WHERE product_id = $productId";
    }
    return runQuery($sql);
}

function searchProductByName($productName){    
    $table = "product";
    $productName = "%".$productName."%";
    $query = "select * from `$table` where `product_name` LIKE '$productName'" ;      
    $retval = runQuery($query);       
    if(!$retval){
        die('<br>Could not get data'.mysqli_connect_error());
    } else {
        return mysqli_fetch_all($retval, MYSQLI_ASSOC);        
    }        
}

?>