<?php

require_once('essential/basket.php');
require_once('essential/product.php');
@session_start();
$customerId = $_SESSION['c_id'];

if(isset($_GET['add_product']) && !empty($_GET['add_product'])){
    // get customer id from the session after login. Default qty = 1.
   
    $productId = $_GET['add_product'];
    $qty = 1;
    $res = addToBasket($customerId, $productId, $qty, $_SESSION['s_id']);
    if($res){
        echo "Product with id: $productId is added to basket";
        // update the available quantities
        updateProductQty($productId,1, true);
        //update the available balance
        updateBalance($productId, $qty, $customerId, true);
        $_SESSION['c_balance'] = getBalance($customerId);
        
    }else{
        echo "Failed to add Product with id: $productId into your basket";
    }
    header("Location:index.php?basket");
}

//----------------------UPDATE PRODUCT QTY-------------------------

if(isset($_POST['updateQty']) && !empty($_POST['qty']) && !empty($_POST['pid'])){
   $res =  updateQtyInBasket($customerId,$_POST['pid'],$_POST['qty']);
   
   if ($res){
       echo "Quantity Updated";
       $_SESSION['c_balance'] = getBalance($customerId);
   }else{
       echo "Failed to update";
   }
   header("Location:index.php?basket");
}

//------------------------DELETE PRODUCT FROM CART-------------------
if(isset($_POST['removeproduct']) &&  !empty($_POST['pid'])){
    $res =  deleteProductFromBasket($customerId, $_POST['pid']);
    if ($res){
        echo "Product removed";
        $_SESSION['c_balance'] = getBalance($customerId);
    }else{
        echo "Failed to remove";
    }
    header("Location:index.php?basket");
}

echo "<div class='centre'>";
// display total available balance
echo "<div><b>Available Balance: Rs. ".$_SESSION['c_balance']."</b></div>";

// view the basket 
$productsInBasket = getCustomerBasket($customerId);
$noOfProducts = sizeof($productsInBasket); 

    if($noOfProducts>0){
        echo "<h3>Products in Basket.</h3></br>";
        $total_expense = 0;
        echo "<table id='baskettble' class='centre-table'>
            <tr>
                <th>Placed Date</th>
                <th>Product</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Quantity</th>                
                <th>Amount</th>
                <th>Action</th>
                
              
            </tr> ";       
        
        for($i = 0; $i< $noOfProducts; $i++){

            $pid = $productsInBasket[$i]['product_id'];
            $pname = $productsInBasket[$i]['product_name'];
            $brand = $productsInBasket[$i]['brand'];
            $price = $productsInBasket[$i]['price'];
            $availability = $productsInBasket[$i]['availability'];
            $placed_date = $productsInBasket[$i]['placed_date'];
            $quantity = $productsInBasket[$i]['quantity'];
            $amount = $quantity * $price;
            $total_expense += $amount;
          
           $maxQty = min($availability+$quantity, 10);
           $self = $_SERVER['PHP_SELF'];
           echo "
           <tr>
            <form  method='POST' action='basketmodule.php'>
            <td>$placed_date</td>
            <td>$pname</td>
            <td>$brand</td>
            <td>$price</td>
            <td><input type='number' min='1' max='$maxQty' name='qty' value='$quantity'/> </td>
            
            <td>$amount</td>
            <td><input type = 'hidden' name='pid' value = '$pid' />
            <input type = 'submit' name='updateQty' value= 'Update'/>
            <input type = 'submit' name = 'removeproduct' value='Remove'/></td> 
                       
            
            
            </form></tr>
            ";
            
            echo "</br>";
        }
        echo "</table>";
        echo "<b>Total Expense: Rs. $total_expense</b></br>";        
        echo "</br>";
    }else{
        echo "<h3>Basket is empty</h3>";
    }
    echo "</div>";
?>