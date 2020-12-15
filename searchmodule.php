<div class='centre' id='search-form'>
    <form method='GET'>
    <label for='searchProduct'></label> 
    <input type='text' name='searchQuery' id = 'searchProduct' placeholder='Search Product by name'/>
    <input type = 'submit' name='searchBtn' value = 'Search'/>
    </form>
</div>

<?php
@session_start();
if(isset($_GET['searchBtn']) && isset($_GET['searchQuery']) && !empty($_GET['searchQuery'])){
    require_once('essential/product.php');
    $searchQuery = $_GET['searchQuery'];
    $products = searchProductByName($_GET['searchQuery']);
    $noOfProducts = sizeof($products);
    echo "<div class='centre'>";
    echo "<h3>$noOfProducts products found for search <i>$searchQuery</i></h3>";
    if($noOfProducts>0){
        echo "<table id='searchtble' class='centre-table' >";
        echo "<tr>
            <th>Product</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Action</th>
        </tr>";
        for($i = 0; $i< $noOfProducts; $i++){

            $pid = $products[$i]['product_id'];
            $pname = $products[$i]['product_name'];
            $brand = $products[$i]['brand'];
            $price = $products[$i]['price'];
            $availability = $products[$i]['availability'];
            echo "<tr>
            <td>$pname</td>
            <td> $brand</td>
            <td>$price</td>
            ";           
           
            if($availability>0){
                if($price<=$_SESSION['c_balance']){
                    echo "<td><a href = basketmodule.php?add_product=$pid>Add to Basket</a></td>";
                }else{
                    echo "<td><b>Insufficient Balance</b></td>";
                }
                
            }else{
                echo "Out of stock!";
            }
            echo "</tr>";
        }
        echo "</table>";
       
    }
    echo "</div>";
    
}

?>