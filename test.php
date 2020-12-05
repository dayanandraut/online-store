<?php
    require_once('./essential/login.php');
    $result = login('daya', 'daya123');
    $result1 = login('anil123', 'Anil123@');
    echo "failed",$result;
   echo "passed",$result1;
?>