<?php
    session_start();
    
    if(isset($_POST['loginBtn']) && !empty($_POST['usernameInput']) && !empty($_POST['passwordInput'])){
        require_once('essential/login.php');
        $result = sellerlogin($_POST['usernameInput'],$_POST['passwordInput']);
        if($result){
            // set session
            $_SESSION['s_id'] = $result['s_id'];
            $_SESSION['s_name'] = $result['seller_name'];        
            $_SESSION['seller_logged'] = true;           
    
        }else{
            echo "Login failed!";
        }
    }

    if(isset($_SESSION['seller_logged'])){
        // display the products to be delivered.
        require_once('essential/seller.php');

       // check for delivery
       if(isset($_POST['deliver']) && isset($_POST['cid']) && !empty($_POST['pid'])){
        deliverProduct($_POST['pid'],$_POST['cid']);
       }
        $sellerId = $_SESSION['s_id']; 
        // view the basket 
        $productsInBasket = getProductsToBeDelivered($sellerId);
        $noOfProducts = sizeof($productsInBasket); 

        if($noOfProducts>0){
            echo "<h3>$noOfProducts Products  are to be Delivered.</h3></br>";           
            for($i = 0; $i< $noOfProducts; $i++){

                
                $pname = $productsInBasket[$i]['product_name'];               
                $price = $productsInBasket[$i]['price'];
                $pid = $productsInBasket[$i]['product_id'];

                $placed_date = $productsInBasket[$i]['placed_date'];
                $quantity = $productsInBasket[$i]['quantity'];

                $cid = $productsInBasket[$i]['c_id'];
                $cname = $productsInBasket[$i]['name']; 
                $phone = $productsInBasket[$i]['phone_no'];
                $totalPrice = $price * $quantity;

            $self = $_SERVER['PHP_SELF'];
            echo "
                <form  method='POST' action='$self'>
                $placed_date $pname $cname $phone Rs. $price $quantity  Rs. $totalPrice                            
                <input type = 'hidden' name='pid' value = '$pid' />
                <input type = 'hidden' name='cid' value = '$cid' />
                <input type = 'submit' name='deliver' value= 'Deliver'/>               
                </form>
                ";
                
                echo "</br>";
            }
                
            echo "</br>";
        }else{
            echo "<h3>There are no products to be delivered.</h3>";
        }

    }else{

    
?>
<div>
<form method='POST'>
 
<input type='text' name='usernameInput' id = 'uname' placeholder='Seller Email'/>

<input type='password' name='passwordInput' id = 'passwd' placeholder='Password'/>

<input type = 'submit' name='loginBtn' value = 'Login'/>
</form>
<div>

<?php
    }

?>