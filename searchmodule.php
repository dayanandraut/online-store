<form method='GET'>
<label for='searchProduct'></label> 
<input type='text' name='searchQuery' id = 'searchProduct' placeholder='Search Product by name'/>
<input type = 'submit' name='searchBtn' value = 'Search'/>
</form>

<?php

if(isset($_GET['searchBtn']) && isset($_GET['searchQuery']) && !empty($_GET['searchQuery'])){
    require_once('essential/searchproduct.php');
    $result2 = search($_GET['searchQuery']);
    echo $result2;
}

?>