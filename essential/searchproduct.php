<?php
    
    require_once('connect.php');

    function search($productName){
        $con = connectToDB();
        $table = "product";
        $productName = "%".$productName."%";
        $query = "select * from `$table` where `product_name` LIKE '$productName'" ;      
        $retval = mysqli_query($con, $query);       
        if(!$retval){
            die('<br>Could not get data'.mysqli_connect_error());
        } else {
            return json_encode(mysqli_fetch_assoc($retval));
        }        
    }
   
?>