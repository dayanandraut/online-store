<form method='GET'>
<label for='searchProduct'></label> 
<input type='text' name='searchQuery' id = 'searchProduct' placeholder='Search Product by name'/>
<input type = 'submit' name='searchBtn' value = 'Search'/>
</form>

<?php

if(isset($_GET['searchBtn']) && isset($_GET['searchQuery']) && !empty($_GET['searchQuery'])){
    require_once('essential/product.php');
    $searchQuery = $_GET['searchQuery'];
    $products = searchProductByName($_GET['searchQuery']);
    $noOfProducts = sizeof($products); 
    echo "<h3>$noOfProducts products found for search <i>$searchQuery</i></h3>";
    if($noOfProducts>0){
        for($i = 0; $i< $noOfProducts; $i++){

            $pid = $products[$i]['product_id'];
            $pname = $products[$i]['product_name'];
            $brand = $products[$i]['brand'];
            $price = $products[$i]['price'];
            $availability = $products[$i]['availability'];
           
            
            echo " $pname $brand  $price";
            if($availability>0){
                echo "<a href = basketmodule.php?add_product=$pid>Add to basket</a></td>";
            }else{
                echo "Out of stock!";
            }
            echo "</br>";
        }
        echo "</br>";
    }
    
}
session_start();
echo $_SESSION['c_id'];
?>