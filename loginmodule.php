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
    echo $result;
}
?>