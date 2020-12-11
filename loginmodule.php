<?php
session_start();
if(isset($_SESSION['c_id'])){
    header("Location: searchmodule.php");
}
?>
<div>
<form method='POST'>
 
<input type='text' name='usernameInput' id = 'uname' placeholder='Username'/>

<input type='password' name='passwordInput' id = 'passwd' placeholder='Password'/>

<input type = 'submit' name='loginBtn' value = 'Login'/>
</form>
<div>


<?php

if(isset($_POST['loginBtn']) && !empty($_POST['usernameInput']) && !empty($_POST['passwordInput'])){
    require_once('essential/login.php');
    $result = login($_POST['usernameInput'],$_POST['passwordInput']);
    if($result){
        // set session
        $_SESSION['c_id'] = $result['c_id'];
        $_SESSION['c_name'] = $result['name'];
        $_SESSION['c_email_id'] = $result['email_id'];
        $_SESSION['c_phone_no'] = $result['phone_no'];    

        header("Location: searchmodule.php");

    }else{
        echo "Login failed!";
    }
}
?>