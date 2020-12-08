<?php
    require_once('./essential/login.php');
    require_once('./essential/searchproduct.php');
    $result = login('daya@abc.com', 'abc123');
    $result1 = login('anil123', 'Anil123@');
    echo "failed",$result;
    echo "passed",$result1;
    $result2 = search('Dov');
   
   echo $result2;
?>