<?php
session_start();
if(empty($_SESSION['admin'])) {
	header("Location: index.php");
}
if(!empty($_POST)){
  extract($_POST);
  var_dump($_POST);

require('../id_connexion.php');

$req = $bdd->prepare('INSERT INTO map (ville, description, longitude, latitude) VALUES (:ville, :description, :longitude, :latitude)');
$req->execute(array('ville'=>UTF8_decode(addslashes($ville)), 'description'=>addslashes($description), 'longitude'=>UTF8_decode(addslashes($longitude)), 'latitude'=>UTF8_decode(addslashes($latitude))));
$req->closeCursor();
header('Location: index.php');
}
?>

<!DOCTYPE html> 
<html lang="fr"> 
 
	<head>
		<meta charset="utf-8">
		<title>Administration</title>
		<meta name="description" content="test Google Map !">
		<meta name="keywords" content="Google Map !">
		<meta name="author" content="Ramanan Manmatharajah">
		<meta name="geo.placename" content="Aurillac-sur-Vendinelle">

		<link rel="stylesheet" href="../css/html.css">
		<link rel="stylesheet" href="../css/style.css" />
	</head> 

	<body>
		<div id="header"></div>
		<div id="content">

<h1>Ajouter un article</h1>
<div class="articles">
	<div class="blog">
        <div class="container-fluid page-body-wrapper full-page-wrapper">


            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><h4> Modifier
                                            Ajouter une agence</h4>
                                    </h4>

                                    <script type="text/javascript" src="../js/jquery.js"></script>
                                    <script type="text/javascript" async
                                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKC41-eGco_z-G0QtC_2CTPRgjMwdGkoo&libraries=places">
                                    </script>
                                    <h1>Ajouter un article</h1>
                                    <div class="articles">
                                        <div class="blog">
                                            <form name="ajout" action="add_article.php" method="post">
                                                <label for="ville">Ville :</label>
                                                <input id="ville" type="text" name="ville" value="<?php if(isset($ville)) echo $ville;?>" />

                                                <label for="longitude">Longitude :</label>
                                                <input id="long" type="text" name="longitude" value="<?php if(isset($longitude)) echo $longitude;?>" />

                                                <label for="latitude">Latitude :</label>
                                                <input id="lat" type="text" name="latitude" value="<?php if(isset($latitude)) echo $latitude;?>" />

                                                <label for="description">Description : </label>
                                                <textarea name="description"></textarea>

                                                <input id="ok" type="submit" name="envoyer" value="Ajouter" />
                                            </form>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        var searchInput = 'ville';

                                        $(document).ready(function () {
                                            var autocomplete;
                                            autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
                                                types: ['geocode'],
                                            });

                                            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                                                var near_place = autocomplete.getPlace();



                                                $("#lat").val(near_place.geometry.location.lat())
                                                $("#long").val(near_place.geometry.location.lng())
                                                $("#ville").val(near_place.address_components[0].long_name)


                                            });

                                        });
                                        $(document).on('change', '#'+searchInput, function () {


                                            $("#lat").val('')
                                            $("#long").val('')
                                            $("#ville").val('')
                                            
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>