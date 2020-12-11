<?php

require_once('essential/basket.php');
require_once('essential/product.php');
session_start();
$customerId = $_SESSION['c_id'];
if(isset($_GET['add_product']) && !empty($_GET['add_product'])){
    // get customer id from the session after login. Default qty = 1.
   
    $productId = $_GET['add_product'];
    $qty = 1;
    $res = addToBasket($customerId, $productId, $qty);
    if($res){
        echo "Product with id: $productId is added to basket";
        // update the available quantities
        updateProductQty($productId,1, true);
    }else{
        echo "Failed to add Product with id: $productId into your basket";
    }
}

// view the basket 
// get customer id from session. meanwhile take it as 5.
$productsInBasket = getCustomerBasket($customerId);
$noOfProducts = sizeof($productsInBasket); 

    if($noOfProducts>0){
        echo "<h3>Products in Basket.</h3></br>";
        for($i = 0; $i< $noOfProducts; $i++){

            $pid = $productsInBasket[$i]['product_id'];
            $pname = $productsInBasket[$i]['product_name'];
            $brand = $productsInBasket[$i]['brand'];
            $price = $productsInBasket[$i]['price'];
            $availability = $productsInBasket[$i]['availability'];
            $placed_date = $productsInBasket[$i]['placed_date'];
           $quantity = $productsInBasket[$i]['quantity'];
            
            echo " $pname $brand  $price $quantity $placed_date";
            
            echo "</br>";
        }
        echo "</br>";
    }else{
        echo "<h3>Basket is empty</h3>";
    }
?>