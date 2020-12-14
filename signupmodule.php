
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
               header('Location:index.php');
            }else{
                echo "<h3>Failed to register.</h3>";
               
            }
        }

       
?>

<div class="centre">
		<h2>Signup</h2>
	<div id="signupform">
		<form method="post">
            <table id="signuptbl" class="centre-table">
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
                        <input type="number" step="any" id="lat" placeholder="Latitude" name="latitude" required >
                       </br> <input type="number" step="any" id="lng" placeholder="Longitude" name="longitude" required >
                    </td>
                </tr>

                <tr>
                    <td> <label>Password : </label> </td>
                    <td><input type="Password" placeholder="Enter Password." name="Password" minlength=8 required ></td>
                </tr>

                <tr >
                    <td colspan='2'>
                    <input type="submit" name = "registerBtn" value="Register">
                    </td>
                </tr>

            </table>
		
        </form>
       </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' /> 
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />
   

        <div class="geocoder">
                <div id="geocoder" ></div>
        </div>

        <div id="map"></div>


<script>

        
        var user_location = [77.8965,29.8649];
        mapboxgl.accessToken = 'pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v9',
            center: user_location,
            zoom: 10
        });

        //  geocoder here
        var geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken            
        });

        var marker ;

        // After the map style has loaded on the page, add a source layer and default
        // styling for a single point.
        map.on('load', function() {
            addMarker(user_location,'load');
           

            // Listen for the `result` event from the MapboxGeocoder that is triggered when a user
            // makes a selection and add a symbol that matches the result.
            geocoder.on('result', function(ev) {
               
                console.log(ev.result.center);

            });
        });

        map.on('click', function (e) {
            marker.remove();
            addMarker(e.lngLat,'click');
           
            document.getElementById("lat").value = e.lngLat.lat;
            document.getElementById("lng").value = e.lngLat.lng;

        });

        function addMarker(ltlng,event) {

            if(event === 'click'){
                user_location = ltlng;
            }
            marker = new mapboxgl.Marker({draggable: true,color:"#d02922"})
                .setLngLat(user_location)
                .addTo(map)
                .on('dragend', onDragEnd);
        }
  

        function onDragEnd() {
            var lngLat = marker.getLngLat();
            document.getElementById("lat").value = lngLat.lat;
            document.getElementById("lng").value = lngLat.lng;
            console.log('lng: ' + lngLat.lng + '<br />lat: ' + lngLat.lat);
        }

       

       document.getElementById('geocoder').appendChild(geocoder.onAdd(map));

    </script>