<?php
    if( isset($_POST['registerBtn']) 
    
        && !empty($_POST['CustomerName'])
        && !empty($_POST['Email'])
        && !empty($_POST['Phonenumber'])
        && !empty($_POST['latitude'])
        && !empty($_POST['longitude'])
        && !empty($_POST['Password'])
        ){          
           
            require_once('essential/customer.php');
            $res = registerCustomer($_POST['CustomerName'], $_POST['Email'], $_POST['Phonenumber'], $_POST['Password'], $_POST['latitude'], $_POST['longitude']);
            if($res){
                echo "<h3>Registered Successfully.</h3>";
               header('Location:loginmodule.php');
            }else{
                echo "<h3>Failed to register.</h3>";
            }
        }

       
?>

<div>
		<font size=7>Signup</font>
	<div id="signupform">
		<form method="post">
            <table id="signuptbl">
                <tr>
                    <td><label>Customer Name : </label></td>
                    <td><input type="text" placeholder="Customer Name" name="CustomerName" minlenght=3  required ></td>
                </tr>

                <tr>     
		            <td> <label>Email Address : </label></td>
                    <td><input type="email" placeholder="abc@gmail.com" name="Email" required ></td>
                </tr>

                <tr>     
		            <td> <label>Phone Number : </label> </td>
                    <td><input type="tel" placeholder="8976435670" name="Phonenumber" pattern="[8-9]{1}[0-9]{9}" required ></td>
                </tr>

                <tr>
                    <td> <label>Address : </label> </td>
                    <td>
                        <input type="number" step="any" placeholder="Latitude" name="latitude" required >
                       </br> <input type="number" step="any" placeholder="Longitude" name="longitude" required >
                    </td>
                </tr>

                <tr>
                    <td> <label>Password : </label> </td>
                    <td><input type="Password" placeholder="Enter Password." name="Password" minlength=8 required ></td>
                </tr>

                <tr>
                    <td>
                    <input type="submit" name = "registerBtn" value="Register">
                    </td>
                </tr>

            </table>
		
        </form>
       </div>
		
</div>