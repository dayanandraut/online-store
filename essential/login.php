<?php
    
    require_once('connect.php');

    function login($username, $password){
        $con = connectToDB();
        $query = "select * from customer where username = '$username' and password = '$password'";
        $retval = mysqli_query($con, $query );
        $row=mysqli_fetch_assoc($retval);
        if($row>=1)
        {
         return 1;
        }else {
            return 0;
        }
    }
   
?>