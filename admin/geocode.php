<?php
session_start();
if(empty($_SESSION['admin'])) {
    header("Location: index.php");
}
if(!empty($_POST)){
    extract($_POST);

    require('../id_connexion.php');
    echo "salut ";
    $req = $bdd->prepare('INSERT INTO map (ville, description, longitude, latitude) VALUES (:ville, :description, :longitude, :latitude)');
    $req->execute(array('ville'=>UTF8_decode(addslashes($ville)), 'description'=>addslashes($description), 'longitude'=>UTF8_decode(addslashes($longitude)), 'latitude'=>UTF8_decode(addslashes($latitude))));
    $req->closeCursor();
    header('Location: index.php');
    $_SESSION['lat'] = "brEE";
    $_SESSION['lng'] = "byeFSDFSD";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>My Geocode App</title>
</head>
<body>
<div class="container">
    <h2 id="text-center">Recherche Adresse: </h2>
    <form id="location-form">
        <input type="text" id="location-input" class="form-control form-control-lg">
        <br>
        <button type="submit" class="btn btn-primary btn-block">Rechercher</button>
    </form>
    <div class="card-block" id="formatted-address"></div>
    <div class="card-block" id="address-components"></div>
    <div class="card-block" id="geometry"></div>
</div>

<script>
    // Call Geocode
    //geocode();

    // Get location form
    var locationForm = document.getElementById('location-form');

    // Listen for submiot
    locationForm.addEventListener('submit', geocode);

    function geocode(e){
        // Prevent actual submit
        e.preventDefault();

        var location = document.getElementById('location-input').value;

        axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
            params:{
                address:location,
                key:'AIzaSyDMSJxO3UfuQ_cufxVd1geCs9Kz4QcKx_k'
            }
        })
            .then(function(response){
                // Log full response
                console.log(response);

                // Formatted Address
                var formattedAddress = response.data.results[0].formatted_address;
                var formattedAddressOutput = `
          <ul class="list-group">
            <li class="list-group-item">${formattedAddress}</li>
          </ul>
        `;

                // Address Components
                var addressComponents = response.data.results[0].address_components;
                var addressComponentsOutput = '<ul class="list-group">';
                for(var i = 0;i < addressComponents.length;i++){
                    addressComponentsOutput += `
            <li class="list-group-item"><strong>${addressComponents[i].types[0]}</strong>: ${addressComponents[i].long_name}</li>
          `;
                }
                addressComponentsOutput += '</ul>';

                // Geometry
                var lat = response.data.results[0].geometry.location.lat;
                var lng = response.data.results[0].geometry.location.lng;
                var geometryOutput = `
          <ul class="list-group">
            <form action="add_article.php" method="post">
            <li
                <input type="text" name="lat" id="location-input" class="form-control form-control-lg"><strong>Latitude</strong>: ${lat}
                <input type="submit" value="Add"/>
            </li>
            <li
                <input type ="text" class="list-group-item"><strong>Latitude</strong>: ${lat}
            </li>
            <li class="list-group-item"><strong>Longitude</strong>: ${lng}</li>
          </ul>
            </form>
        `;

                // Output to app
                document.getElementById('formatted-address').innerHTML = formattedAddressOutput;
                document.getElementById('address-components').innerHTML = addressComponentsOutput;
                document.getElementById('geometry').innerHTML = geometryOutput;
            })
            .catch(function(error){
                console.log(error);
            });


    }
</script>
</body>
</html>