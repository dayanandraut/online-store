<?php 
session_start();
if(isset($_GET['logout'])){
  include("logout.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Online Store</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/style.css">
  </head>

  <body>
  <div class="navbar">
      <a href="index.php">Home</a>
           
      
      <a href="about.html" class="right">About</a>

      <?php 
      if(!isset($_SESSION['customer_logged']) && !isset($_SESSION['seller_logged'])){
      echo  "<a href='?retailer' class='right'>Retailer</a>";
       echo "<a href='?signup' class='right'>Sign Up</a>";      
      }else{
        echo "<a href='?logout' class='right'>Logout</a>";
        if(isset($_SESSION['customer_logged'])){
          $uname = strtoupper($_SESSION['c_name']);
          $blc = $_SESSION['c_balance'];
          echo "<span id='wallet'>$uname : Rs. $blc</span>";
          echo "<a href='?searchproduct' class='right'>Search</a>";
          
        }      
        if(isset($_SESSION['seller_logged'])){  
          $sname = strtoupper($_SESSION['s_name']);
          echo "<span id='wallet'>$sname </span>";
        }
        echo "<a href='?basket' class='right'>Basket</a>";
        
      } 
        ?>
    </div>

    <?php 
   
    ?>
   
    <div id="">
        <?php
        if(!isset($_SESSION['customer_logged']) && !isset($_SESSION['seller_logged'])){

       
          if(isset($_GET['signup'])){            
            include('signupmodule.php');
          }
          
          else if(isset($_GET['retailer'])){            
            include_once('sellermodule.php');
          }else{
            echo "
            <div class='header'>
            <h1>Online Shop</h1>
            <p>A website created by IITR Students</p>";
            include('loginmodule.php');
            echo "<p>New to our portal? Please <a href=?signup>Register</a> today.";
          echo "</div> ";
          }
        }

        if(isset($_SESSION['customer_logged'])){
          if(isset($_GET['basket'])){
            include('basketmodule.php');
          } else{
            include('searchmodule.php');
          }
          
        }

        if(isset($_SESSION['seller_logged'])){          
            include_once('sellermodule.php');       
          
        }
        ?>

    </div>

  </body>


</html>
