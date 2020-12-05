<?php         
    
    function connectToDB(){
        
        $server="localhost"; 
        $user="root"; 
        $pass=""; 
        $db="projectonlinebookstore"; 
        // connect to mysql       
        $conn = mysqli_connect($server, $user, $pass) or die("Sorry, can't connect to the mysql."); 
        if($conn){
            echo "Connected to $server <br>";
        }

        // select the db       
        $connect_to_db = mysqli_select_db($conn, $db) or die("Sorry, can't select the database."); 
        if($connect_to_db){
            echo "Connected to $db <br>";
        }

        return $conn;
    }
  
?>