<?php
    include_once('queryrunner.php');

    function registerCustomer($name, $email, $phone, $password, $lat, $lon){
        // find the nearest seller id first by using $lat and $lon
        // for test purpose, I am using sellerId = 1
        $sellerId = 1;
        // default balance = 1000
        $balance = 1000;
        $sql = "INSERT INTO `customer` (`name`, `email_id`, `password`, `phone_no`, `balance`, `c_lat`, `c_lon`, `c_s_id`)
                 VALUES ('$name', '$email', '$password', '$phone', '$balance', '$lat', '$lon', '$sellerId')";
        
        return runQuery($sql);         
    }

?>