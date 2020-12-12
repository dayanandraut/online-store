<?php
include_once('queryrunner.php');
include_once('product.php');
    function getCustomerBasket($customerId){
        $sql = "SELECT * FROM `basket` inner join `product` WHERE customer_id = $customerId and basket.product_id = product.product_id";
        $res = runQuery($sql);
        if($res){
            return mysqli_fetch_all($res, MYSQLI_ASSOC);
        }
      
    }

    function addToBasket($customerId, $productId, $qty, $sellerId){
        $sql = "INSERT INTO `basket` (`customer_id`, `product_id`, `quantity`, `seller_id`) VALUES ('$customerId', '$productId', '$qty', '$sellerId')";
        return runQuery($sql);
    }
    

    function updateBalance($productId, $qty, $customerId, $buy){
        $sql  = "UPDATE  customer set balance = balance - (SELECT $qty*price from `product` where product_id = $productId) where c_id = $customerId";
        if(!$buy){
            $sql  = "UPDATE  customer set balance = balance + (SELECT $qty*price from `product` where product_id = $productId) where c_id = $customerId";
        }
        return runQuery($sql);
    }

    function getBalance($customerId){
        $sql = "SELECT balance  FROM `customer` WHERE c_id = $customerId";
        $res = runQuery($sql);
        if($res){
            $row=mysqli_fetch_assoc($res);           
                return $row['balance'];            
        }
    }

    function updateQtyInBasket($customerId,$productId,$qty){
        
        $q1 = "SELECT quantity from basket where customer_id = $customerId and product_id = $productId";
        $r1 = runQuery($q1);       
        $basket = mysqli_fetch_assoc($r1);
        $basketQty = $basket['quantity'];

        $q2 = "SELECT price, availability FROM `product` where product_id=$productId";
        $r2 = runQuery($q2);
        $product = mysqli_fetch_assoc($r2);
        $productPrice = $product['price'];
        $productAvailibity = $product['availability'];

        $diff = $qty - $basketQty;
        if($diff==0){
            return array("status"=> false, "message"=>"No changes made");
        }

        if($diff>$productAvailibity){
            return array("status"=> false, "message"=>"out of stocks. Only $productAvailibity available");
        }
        
        $q3 = "SELECT balance FROM `customer` where c_id = $customerId";
        $r3 = runQuery($q3);
        $customer = mysqli_fetch_assoc($r3);
        $customerBalance = $customer['balance'];

        $moneyRequired = $diff * $productPrice;

        if($moneyRequired>$customerBalance){
            return array("status"=> false, "message"=>"Insufficient Balance. Available balance: Rs. $customerBalance");
        }
        
        
        // update quantity in basket.
        $q4 = "UPDATE `basket` SET `quantity`=$qty WHERE customer_id = $customerId and product_id = $productId";
        runQuery($q4);

        // update quantity in product.
        $sold = $diff>0;
        updateProductQty($productId, abs($diff), $sold);

        // update customer balance.
        $buy = $diff>0;
        updateBalance($productId, abs($diff), $customerId, $buy);

        return array("status"=>true, "message"=>"Quantity updated.");
            
    }

    function deleteProductFromBasket($customerId, $productId){
        $q1 = "SELECT quantity from basket where customer_id = $customerId and product_id = $productId";
        $r1 = runQuery($q1);       
        $basket = mysqli_fetch_assoc($r1);
        $qty = $basket['quantity'];

        $q2 = "SELECT price FROM `product` where product_id=$productId";
        $r2 = runQuery($q2);
        $product = mysqli_fetch_assoc($r2);
        $productPrice = $product['price'];

        // update qty in product
        updateProductQty($productId, $qty, false);

        //update balance in customer
        updateBalance($productId, $qty, $customerId, false);

        // delete the entry from the basket.
        $q3 = "DELETE FROM `basket` WHERE `customer_id` = $customerId AND `product_id` = $productId";
        return runQuery($q3);   


    }

?>