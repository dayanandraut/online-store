<?php
require_once('connect.php');

function runQuery($query){
    $con = connectToDB();
    $retval = mysqli_query($con, $query);       
    return $retval;
}

?>